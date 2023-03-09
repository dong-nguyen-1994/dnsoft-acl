<?php

namespace DnSoft\Acl;

use DnSoft\Acl\Contracts\PermissionManagerInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PermissionManager implements PermissionManagerInterface
{
    /**
     * All permissions
     * @var array
     */
    protected $permissions = [];

    /**
     * All permissions in tree list
     * @var array
     */
    protected $treePermissions = [];

    /**
     * @return array
     */
    public function all()
    {
        return $this->permissions;
    }

    /**
     * @return array
     */
    public function allTree()
    {
        return Arr::sort($this->treePermissions);
    }

    /**
     * Get all Permission Without Key.
     * @return array
     */
    public function allTreeWithoutKey()
    {
        return $this->removeChildrenKey($this->allTree());
    }

    /**
     * @param $array
     * @return array
     */
    private function removeChildrenKey($array)
    {
        $newData = [];

        foreach ($array as $key => $item) {
            if (!empty($item['children'])) {
                $item['children'] = $this->removeChildrenKey($item['children']);
            }

            $newData[] = $item;
        }

        return $newData;
    }

    public function add($key, $label)
    {
        $originKey = $key;

        $key = Str::replaceFirst('.admin.', '.', $key);
        $this->permissions[$originKey] = $label;

        $this->setDefaultGroupLabel($key);

        $arrKey = str_replace('.', '.children.', $key);
        Arr::set($this->treePermissions, $arrKey, [
            'key'   => $originKey,
            'label' => $label,
        ]);
        return $this;
    }

    private function setDefaultGroupLabel($key)
    {
        $segments = explode('.', $key);
        foreach ($segments as $segment) {
            array_pop($segments);

            if (empty($segments)) {
                continue;
            }

            $groupKey = implode('.', $segments);
            $groupLabelKey = str_replace('.', '.children.', $groupKey) . '.label';

            if (!Arr::has($this->treePermissions, $groupLabelKey)) {
                Arr::set($this->treePermissions, $groupLabelKey, ucfirst(last($segments)));
            }
        }
    }
}
