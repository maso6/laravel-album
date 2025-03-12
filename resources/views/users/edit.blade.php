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
                                                    <h1 class="h4 text-gray-500 mb-4">Opdater bruger</h1>
                                                </div>

                                                {{ html()->form('POST')->route('users.update', $user->id)->open() }}

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <strong>Navn:</strong>
                                                            <input type="text" class="form-control" name="name" placeholder="Name">  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <strong>Email:</strong>
                                                            <input type="text" class="form-control" name="email" placeholder="Email">  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <strong>Password:</strong>
                                                            <input type="password" class="form-control" name="password" placeholder="Password">  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <strong>Bekræft password:</strong>
                                                            <input type="password" class="form-control" name="confirm-password" placeholder="Bekræft Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <strong>Rolle:</strong>
                                                            <select name="roles" class="form-control" multiple="true"> 
                                                                @foreach ($roles as $role ) 
                                                                <option value="{{ $role }}">{{ $role }}</option> 
                                                                @endforeach 
                                                            </select>
                                                            <br>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <a class="btn btn-light btn-user btn-block" href="/users">Tilbage</a>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-primary btn-user btn-block">Opdater</button>
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
        background: url(<?php echo asset('img/dog-hat.gif') ?> );
        background-position: center;
        background-size: cover;
    }
</style>

@include('base.bottom') 
</html>