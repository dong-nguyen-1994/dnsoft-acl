<div class="card-body">
    @input(['name' => 'name', 'label' => __('acl::role.name'), 'require' => true])
    @input(['name' => 'display_name', 'label' => __('acl::role.display_name'), 'require' => true])
    @textarea(['name' => 'description', 'label' => __('acl::role.description')])
</div>
