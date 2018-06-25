@extends('layouts.app')
@push('styles')
<link href="{{ asset('vendors/Datatable/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/pnotify/pnotify.custom.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="">
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <!-- x_title -->
        <div class="x_title">
            <h2><i class="fa fa-user"></i> Permissions</h2>
            <div class="pull-right">
                <a class="btn btn-success btn-sm" href="{{ route('permissions.create') }}"> Add Permission</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- x_title -->
        <!-- x_content -->
        <div class="x_content">
           @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <p>{{ $message }}</p>
            </div>
            @endif

            <table class="table table-hover table-condensed display" id="permission_tbl">
              <thead>
                <tr>
                 <th>No</th>
                 <th>Name</th>
                 <th width="280px">Action</th>
               </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $permission)
                <tr>
                  <td>{{ $permission->id }}</td>
                  <td>{{ $permission->name }}</td>
                  <td>
                     <a class="btn btn-primary btn-xs" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
                      {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                      {!! Form::close() !!}
                  </td>
                </tr>
                @endforeach
              </tbody>
              
            </table>
        </div>
        <!-- x_content -->
      </div>
    </div>
  </div>
</div>


@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('vendors/Datatable/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/pnotify/pnotify.custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app/permission/index.js') }}"></script>
@endpush