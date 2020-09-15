<?php

namespace Dnsoft\Acl\Http\Controllers\Admin;

use Dnsoft\Acl\Http\Requests\RoleRequest;
use Dnsoft\Acl\Repositories\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $items = $this->roleRepository->paginate(20);
        return view('acl::admin.role.index', compact('items'));
    }

    public function create()
    {
        $item = null;
        return view('acl::admin.role.create', compact('item'));
    }

    public function store(RoleRequest $request)
    {
        $item = $this->roleRepository->create($request->all());

        if ($request->input('continue')) {
            return redirect()
                ->route('admin.role.edit', $item->id)
                ->with('success', __('acl::role.notification.created'));
        }

        return redirect()
            ->route('admin.role.index')
            ->with('success', __('acl::role.notification.created'));
    }

    public function edit($id)
    {
        $item = $this->roleRepository->getById($id);
        return view('acl::admin.role.edit', compact('item'));
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request, $id)
    {
        $item = $this->roleRepository->updateById($request->all(), $id);

        if ($request->input('continue')) {
            return redirect()
                ->route('admin.role.edit', $item->id)
                ->with('success', __('acl::role.notification.created'));
        }

        return redirect()
            ->route('admin.role.index')
            ->with('success', __('acl::role.notification.updated'));
    }
}
