<!DOCTYPE html>
<html lang="en">
@include('base.header') 

<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            @include('base.navigation') 
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('base.topbar') 

                <!-- Begin Page Content -->
                <div class="container">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                <strong>Whoops!</strong>Felterne er ikke udfyldt korrekt<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                         
                    <!-- Outer Row -->
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 col-md-9">
                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-lg-4 d-none d-lg-block bg-login-image"></div>
                                        <div class="col-lg-8">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-500 mb-4">Opret rolle</h1>
                                                </div>

                                                {{ html()->form('POST')->route('roles.store')->open() }}

                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>Name:</strong>
                                                            <input type="text" class="form-control" name="name" placeholder="Name">  
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>Permission:</strong>
                                                        <div class="form-group permissions">
                                                            @foreach($permission as $value)
                                                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                                                {{ $value->name }}</label><br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <a class="btn btn-light btn-user btn-block" href="/roles">Tilbage</a>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-primary btn-user btn-block">Opret</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{ html()->form()->close() }}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('base.footer') 
        </div>
    </div>
    @include('base.arrowup') 
    @include('base.logoutmodal') 
</body>

<style>
    .bg-login-image {
        background: url(<?php echo asset('img/tail-walk.gif') ?> );
        background-position: center;
        background-size: cover;
    }
    .form-group.permissions {
      max-height: 400px;
      width: 100%;
      overflow-y: scroll;
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 5px;
  }
</style>

@include('base.bottom') 
</html>

