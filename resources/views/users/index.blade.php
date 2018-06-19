@extends('layouts.app')
@push('styles')
<link href="{{ asset('vendors/Datatable/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/pnotify/pnotify.custom.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="">
  <!-- <div class="page-title">
      <div class="title_left">
        <h3>Users Management</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
      </div>
  </div>
     -->
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <!-- x_title -->
        <div class="x_title">
            <h2><i class="fa fa-user"></i> Users Management</h2>
            <div class="pull-right">
                <a class="btn btn-success btn-sm" href="{{ route('users.create') }}"> Create New User</a>
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

            <table class="table table-hover table-bordered display" id="user_tbl">
              <thead>
                <tr>
                 <th>No</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Roles</th>
                 <th>Status</th>
                 <th width="280px">Action</th>
               </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @if(!empty($user->getRoleNames()))
                      @foreach($user->getRoleNames() as $v)
                         <label class="badge badge-success">{{ $v }}</label>
                      @endforeach
                    @endif
                  </td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="flat status_chk" @if($user->active) checked @endif data-id="{{$user->id}}">
                      </label>
                    </div>
                  </td>
                  <td>
                     <a class="btn btn-info btn-xs" href="{{ route('users.show',$user->id) }}">Show</a>
                     <a class="btn btn-primary btn-xs" href="{{ route('users.edit',$user->id) }}">Edit</a>
                      {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
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
<script type="text/javascript" src="{{ asset('js/app/user/index.js') }}"></script>
@endpush