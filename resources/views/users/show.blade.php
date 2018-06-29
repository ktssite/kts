@extends('layouts.app')
@push('styles')
<link href="{{ asset('vendors/pnotify/pnotify.custom.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="">
    <!-- <div class="page-title">
      <div class="title_left">
        <h3>User Profile</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div> -->
    
    <div class="clearfix"></div>
    <!-- row -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <!-- x_title -->
                <div class="x_title">
                    <h2>User Profile</h2>
                    <!-- <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a></li> 
                    </ul>-->
                    <div class="clearfix"></div>
                </div>
                <!-- x_title -->
                <!-- x_content -->
                <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img show-image">
                            <div id="crop-avatar">
                              <!-- Current avatar -->
                                <img class="img-responsive avatar-view" src="{{ $user->getAvatar() }}" alt="Avatar" title="Change the avatar">
                                <a id="img-update" class="prof-btn btn btn-info btn-xs" data-toggle="modal" data-target="#profPicModal"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                <!-- <a id="img-delete" class="prof-btn btn btn-danger btn-xs">Delete</a> -->
                            </div>
                        </div>
                        <h3>{{ $user->username }}</h3>
                        <!--<ul class="list-unstyled user_data">
                            <li><i class="fas fa-id-card user-profile-icon"></i> {{$user->name}}</li>
                            <li><i class="fas fa-at user-profile-icon"></i> {{$user->email}}</li>

                             <li class="m-top-xs">
                              <i class="fa fa-external-link user-profile-icon"></i>
                              <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                            </li>
                        </ul> -->
                        <a class="btn btn-success btn-xs" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                        <br />
                        <br />
                        <h4>Role(s)</h4>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a></li>
                              <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a></li>
                              <!-- <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a></li> -->
                            </ul>
                        </div>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab"></div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <br><br><br>
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> <i class="fas fa-id-card user-profile-icon"></i> Name </span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <span class="form-text-value col-md-7 col-xs-12">{{$user->name}}</span>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><i class="fas fa-at user-profile-icon"></i> Email
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <span class="form-text-value col-md-7 col-xs-12">{{$user->email}}</span>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"><i class="glyphicon glyphicon-calendar"></i> Trading day</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <span class="form-text-value col-md-7 col-xs-12">{{ ($user->trading_day) ? config('app.weekdays')[$user->trading_day] : '' }}</span>
                                            </div>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- x_content -->
            </div>
        </div>
    </div>
    <!-- row -->
</div>

<!-- Modal -->
<div class="modal fade" id="profPicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile Picture</h5>
      </div>
      <div class="modal-body">
        <div class="show-image-modal">
            <img class="img-responsive avatar-view" src="{{ $user->getAvatar() }}" alt="Avatar">
        </div>
        <br>
        <div class="clearfix"></div>
        <form enctype="multipart/form-data" id="fileinfo" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{$user->id}}">
          <div class="form-group">
            <label for="pImage">Select image</label>
            <input type="file" name="avatar" class="form-control-file" id="pImage">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="upload-profimg" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('vendors/pnotify/pnotify.custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app/user/show.js') }}"></script>
@endpush