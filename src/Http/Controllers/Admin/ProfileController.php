<?php

namespace DnSoft\Acl\Http\Controllers\Admin;

use DnSoft\Acl\Http\Requests\ProfileRequest;
use DnSoft\Acl\Repositories\AdminRepositoryInterface;
use DnSoft\Core\Facades\MenuAdmin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * @var AdminRepositoryInterface
     */
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $items = $this->adminRepository->paginate(20);
        $version = get_version_actived();
        return view("acl::$version.admin.profile.index", compact('items'));
    }

    public function create()
    {
        MenuAdmin::activeMenu('admin');
        $item = null;
        $version = get_version_actived();
        return view("acl::$version.admin.profile.create", compact('item'));
    }

    public function store(ProfileRequest $request)
    {
        $item = $this->adminRepository->createWithRoles($request->all(), $request->input('roles', []));

        if ($request->input('continue')) {
            return redirect()
                ->route('admin.profile.edit', $item->id)
                ->with('success', __('acl::profile.notification.created'));
        }

        return redirect()
            ->route('admin.profile.index')
            ->with('success', __('acl::profile.notification.created'));
    }

    public function edit($id)
    {
        MenuAdmin::activeMenu('admin');
        $item = $this->adminRepository->getById($id);
        $version = get_version_actived();
        return view("acl::$version.admin.profile.edit", compact('item'));
    }

    /**
     * @param ProfileRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request, $id)
    {
        $item = $this->adminRepository->updateAndSyncRoles($id, $request->all(), $request->input('roles', []));

        if ($request->input('continue')) {
            return redirect()
                ->route('admin.profile.edit', $item->id)
                ->with('success', __('acl::profile.notification.created'));
        }

        return redirect()
            ->route('admin.profile.index')
            ->with('success', __('acl::profile.notification.updated'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        $this->adminRepository->delete($id);

        if ($request->wantsJson()) {
            Session::flash('success', __('acl::profile.notification.deleted'));
            return response()->json([
                'success' => true,
            ]);
        }

        return redirect()
            ->route('admin.profile.index')
            ->with('success', __('acl::profile.notification.deleted'));
    }
}
