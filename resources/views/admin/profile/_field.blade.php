<div class="card-body">
    @input(['name' => 'name', 'label' => __('acl::profile.name')])
    @input(['name' => 'email', 'label' => __('acl::profile.email')])
    <div class="row">
        <div class="col-md-6">
            @input(['name' => 'password', 'type' => 'password', 'label' => __('acl::profile.password')])
        </div>
        <div class="col-md-6">
            @input(['name' => 'password_confirmation', 'type' => 'password', 'label' => __('acl::profile.password_confirmation')])
        </div>
    </div>
{{--    @sumoselect(['name' => 'role', 'label' => 'Roles', ])--}}
    @sumoselect(['name' => 'roles', 'label' => __('acl::role.page_title'), 'multiple' => true, 'options' => get_roles_options()])

    @checkbox(['name' => 'is_admin', 'label' => '' , 'placeholder' => __('acl::profile.is_admin')])

    @mediafile(['name' => 'avatar', 'label' => __('acl::profile.avatar')])
</div>
