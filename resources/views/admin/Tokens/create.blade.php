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

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800">Tokens</h1>
                     <p class="mb-4">
                        Herunder er en liste over Tokens
                    </p>

                  <!-- DataTales Example -->
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tokens</h6>
                     </div>
            
                     <div class="card-body">

                        {{ html()->form('POST')->acceptsFiles()->route('admin.tokens.store')->open() }} 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" class="form-control" name="name">  
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Description:</strong>
                                        <input type="text" class="form-control" name="description">  
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Token:</strong><br>
                                        <input type="text" class="form-control" name="token" value="{{$uuid}}" readonly> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="btn btn-light btn-user btn-block" href="/admin/tokens">Back</a>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Opret</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{ html()->form()->close() }}





                           
                     </div>
                  </div>
                </div>

                <!-- End of Page Content -->

            </div>
            @include('base.footer') 
        </div>
    </div>
    @include('base.arrowup') 
    @include('base.logoutmodal') 
</body>

@include('base.bottom') 
</html>
