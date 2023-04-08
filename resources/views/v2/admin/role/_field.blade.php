<div class="col-md-8 col-sm-8">
@input(['name' => 'name', 'label' => __('acl::role.name'), ])
@input(['name' => 'display_name', 'label' => __('acl::role.display_name'), ])
@textarea(['name' => 'description', 'label' => __('acl::role.description'),])
</div>
<div class="col-md-4 col-sm-4">
  <h6 class="ml-2">Permission</h6>

  <!-- <dnsoft-tree name="permissions" :data='@json(\Dnsoft\Acl\Facades\Permission::allTreeWithoutKey())' :value='@json(json_decode(object_get($item, ' permissions')))'></dnsoft-tree> -->

  <a id="element-trigger-1"></a>
  <div
    id="tree-view-component-1"
    data-name="permissions"
    data-items='@json(\Dnsoft\Acl\Facades\Permission::allTreeWithoutKey())'
    data-displayall="false"
    data-checked='@json(json_decode(object_get($item, "permissions")))'
    data-checkable="true"
    data-showline="false"
    style="border: 1px solid #ababab; border-radius: 5px; margin-top: 10px"
  ></div>

  <div class="form-group row mt-4">
    <div class="col-12">
      <button type="submit" class="btn btn-primary" style="font-size: 1.1em;"><i class="fa fa-save"></i> {{ __('core::button.save') }}</button>
      <button class="btn btn-secondary" name="continue" value="1" type="submit" style="font-size: 1.1em;"><i class="fa fa-arrow-circle-o-right"></i> {{ __('core::button.save_and_edit') }}</button>
    </div>
  </div>
</div>
