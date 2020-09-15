@extends('core::admin.master')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('acl::role.index.page_title') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('acl::role.index.page_title') }}</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <a class="btn btn-primary" href="{{ route('admin.role.create') }}"><i class="fas fa-plus">Add</i></a>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('acl::role.name') }}</th>
                                <th>{{ __('acl::role.display_name') }}</th>
                                <th>{{ __('acl::role.created_at') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td><a href="{{ route('admin.role.edit', $item->id) }}">{{ $item->id }}</a></td>
                                <td><a href="{{ route('admin.role.edit', $item->id) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->display_name }}</td>
                                <td>{{ $item->created_at }}</td>
{{--                                <td><span class="tag tag-success">Approved</span></td>--}}
                                <td class="text-right">
                                    <a href="{{ route('admin.role.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(143 231 243);color: #0fac04">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button-delete url-delete="{{ route('admin.role.destroy', $item->id) }}"></button-delete>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@stop
