<div class="card-body">
    @input(['name' => 'name', 'label' => __('acl::profile.name')])
    @input(['name' => 'email', 'label' => __('acl::profile.email')])
    @input(['name' => 'password', 'type' => 'password', 'label' => __('acl::profile.password')])
    @input(['name' => 'password_confirmation', 'type' => 'password', 'label' => __('acl::profile.password_confirmation')])
    @checkbox(['name' => 'is_admin', 'label' => '' , 'placeholder' => __('acl::profile.is_admin')])
</div>
