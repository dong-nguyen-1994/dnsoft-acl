
<div class="col-md-8 col-sm-8">
  @input(['name' => 'name', 'label' => __('acl::profile.name'), 'require' => true])
  @input(['name' => 'email', 'label' => __('acl::profile.email'), 'require' => true])
  @input(['name' => 'password', 'type' => 'password', 'label' => __('acl::profile.password'), 'require' => true])
  @input(['name' => 'password_confirmation', 'type' => 'password', 'label' => __('acl::profile.password_confirmation'), 'require' => true])
</div>
<div class="col-md-4 col-sm-4">
  @sumoselect(['name' => 'roles', 'label' => __('acl::role.page_title'), 'multiple' => true, 'options' => get_roles_options()])
  @checkbox(['name' => 'is_admin', 'label' => '' , 'placeholder' => __('acl::profile.is_admin')])
  <hr>
  <x-button-save-edit/>

</div>
