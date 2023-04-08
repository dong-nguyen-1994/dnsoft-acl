@extends('core::v2.admin.master')

@section('title', __('acl::profile.create.page_title'))

@section('breadcrumbs')
<div class="title_left" style="margin-bottom: 1em;">
  <div class="page-title-box">
    <div class="page-title-right">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><i class="fa fa-home mr-1"></i><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">{{ __('acl::profile.index.page_title') }}</a></li>
        <li class="breadcrumb-item active">{{ __('acl::profile.create.index') }}</li>
      </ol>
    </div>
  </div>
</div>
@endsection

@section('content')
<form role="form" action="{{ route('admin.profile.store') }}" method="POST">
  @csrf
  <div class="row" style="display: block;">
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12">
      <div class="x_panel">
        @include('acl::v2.admin.profile._field')
      </div>
    </div>
  </div>
</form>
@stop