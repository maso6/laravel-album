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

                  <!-- DataTales Example -->
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Galleries</h6>
                     </div>
            
                     <div class="card-body">

         
                        {{ html()->form('POST')->acceptsFiles()->route('admin.images.update', $image['id'])->open() }} 
                            <input name="id" type="hidden" value="{{$image['id']}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Description:</strong>
                                        <input type="text" class="form-control" name="description" value="{{ $image['description'] }}">  
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Image:</strong><br>
                                        <img src="data:image/png;base64, {{ $image['image'] }}" width="50px" /></br>
                                        <input name="newimage" class="form-control" type="file" id="newimage">
                                        <input name="image" type="hidden" value="{{$image['image']}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="btn btn-light btn-user btn-block" href="/admin/galleries/{{$image['gallery_id']}}">Back</a>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <a class="btn btn-danger btn-user btn-block" href="/admin/images/{{$image['id']}}/delete">Delete</a>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
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
