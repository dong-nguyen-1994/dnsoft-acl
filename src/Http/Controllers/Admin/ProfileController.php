<?php

namespace Dnsoft\Acl\Http\Controllers\Admin;

use Dnsoft\Acl\Repositories\AdminRepositoryInterface;
use Illuminate\Routing\Controller;

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
        return view('acl::admin.profile.index');
    }
}
