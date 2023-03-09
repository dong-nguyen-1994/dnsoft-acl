<?php

namespace DnSoft\Acl\Http\Controllers\Admin;

use DnSoft\Acl\Http\Requests\RoleRequest;
use DnSoft\Acl\Repositories\RoleRepositoryInterface;
use DnSoft\Core\Facades\MenuAdmin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

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
        $version = get_version_actived();
        return view("acl::$version.admin.role.index", compact('items'));
    }

    public function create()
    {
        MenuAdmin::activeMenu('role');
        $item = null;
        $version = get_version_actived();
        return view("acl::$version.admin.role.create", compact('item'));
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
        MenuAdmin::activeMenu('role');
        $item = $this->roleRepository->getById($id);
        $version = get_version_actived();
        return view("acl::$version.admin.role.edit", compact('item'));
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return RedirectResponse
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

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        $this->roleRepository->delete($id);

        if ($request->wantsJson()) {
            Session::flash('success', __('acl::role.notification.deleted'));
            return response()->json([
                'success' => true,
            ]);
        }

        return redirect()
            ->route('admin.role.index')
            ->with('success', __('acl::role.notification.deleted'));
    }
}
