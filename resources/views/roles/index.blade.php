@extends('layouts.app')
@push('styles')
<link href="{{ asset('vendors/Datatable/datatables.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="">
    
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <!-- x_title -->
        <div class="x_title">
            <h2><i class="fa fa-users"></i> Role Management</h2>
            <div class="pull-right">
                @can('role-create')
                <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}"> Create New Role</a>
                @endcan
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- x_title -->
        <!-- x_content -->
        <div class="x_content">
            @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <p>{{ $message }}</p>
              </div>
              <br>
            @endif
            
            <div class="col-xs-3">
              <!-- required for floating -->
              <!-- Nav tabs -->
              <ul class="nav nav-tabs tabs-left roles-nav">
                @foreach($data as $key => $role)
                <li class="{{ ($key == 0) ? 'active' : '' }}"><a href="#{{strtolower($role->name)}}" data-toggle="tab"><b>{{ $role->name }}</a></b></li>
                @endforeach
              </ul>
            </div>

            <div class="col-xs-9">              
              <!-- Tab panes -->
              <div class="tab-content">
                @foreach($data as $key => $role)
                <div class="tab-pane {{ ($key == 0) ? 'active' : '' }}" id="{{strtolower($role->name)}}">                  
                  <div class="row">
                      <div class="col-lg-12 margin-tb">
                          <div class="pull-left">
                              <p class="lead">Permissions - <b>{{ $role->name }}</b></p>
                          </div>
                          <div class="pull-right">
                              @can('role-edit')
                                <a class="btn btn-info btn-xs" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-pencil-alt "></i> Edit</a>
                              @endcan
                              @can('role-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                  <button type="submit" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i> Delete</button>
                                {!! Form::close() !!}
                              @endcan
                          </div>
                      </div>
                  </div>
                  <div class="">
                    <table class="table table-striped table-condensed">
                      @foreach($role->permissions as $permission)
                      <tr>
                        <td width="5%"> <i class="far fa-check-square"></i> </td>
                        <td>{{ $permission->name }}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
                @endforeach
                <br>
              </div>
            </div>

          <div class="clearfix"></div>

        </div>
        <!-- x_content -->
      </div>
    </div>
  </div>
</div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('vendors/Datatable/datatables.min.js') }}"></script>
@endpush