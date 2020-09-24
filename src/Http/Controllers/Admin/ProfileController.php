<?php

namespace Dnsoft\Acl\Http\Controllers\Admin;

use Dnsoft\Acl\Http\Requests\ProfileRequest;
use Dnsoft\Acl\Repositories\AdminRepositoryInterface;
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
        $items = $this->adminRepository->paginate(2);
        return view('acl::admin.profile.index', compact('items'));
    }

    public function create()
    {
        $item = null;
        return view('acl::admin.profile.create', compact('item'));
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
        $item = $this->adminRepository->getById($id);
        return view('acl::admin.profile.edit', compact('item'));
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request, $id)
    {
        $item = $this->adminRepository->updateById($request->all(), $id);

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
