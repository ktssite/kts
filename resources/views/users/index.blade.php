@extends('layouts.app')


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
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
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

            <table class="table table-bordered">
             <tr>
               <th>No</th>
               <th>Name</th>
               <th>Email</th>
               <th>Roles</th>
               <th width="280px">Action</th>
             </tr>
             @foreach ($data as $key => $user)
              <tr>
                <td>{{ ++$i }}</td>
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
                   <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                   <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
              </tr>
             @endforeach
            </table>
        </div>
        <!-- x_content -->
      </div>
    </div>
  </div>
</div>


{!! $data->render() !!}


@endsection