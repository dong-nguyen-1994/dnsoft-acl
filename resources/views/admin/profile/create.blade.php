@extends('core::admin.master')

@section('meta_title', __('acl::profile.index.page_title'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">{{ __('acl::profile.index.page_title') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('acl::profile.create.index') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('acl::profile.create.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form role="form" action="{{ route('admin.profile.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title mb-1">{{ __('acl::profile.create.page_title') }}</h4>
                    </div>
                    @include('acl::admin.profile._field')
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('core::button.save') }}</button>
                        <button class="btn btn-secondary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
