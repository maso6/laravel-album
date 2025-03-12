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
                <form action="{{ route('admin.galleries.index_admin') }}" method="GET" enctype="multipart/form-data">@csrf <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search_field" value="<?php if($search_field) { echo $search_field; }; ?>">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                    </div>
                  </div>
                </form>
                <a class="btn btn-outline-secondary" href="/admin/galleries/create">Opret ny</a>
                <hr>
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th>Created_at</th>
                      <th>title</th>
                      <th>Image</th>
                      <th>Rediger</th>
                    </tr>
                  </thead>
                  <tbody> 
                     @foreach($paginator->items() as $item)
                     <tr>
                      <td>{{ $item->created_at }}</td>
                      <td>{{ $item->title }}</td>
                      <td>
                        <img src="data:image/png;base64, {{ $item['image'] }}" width="100px" />
                      </td>
                      <td class="main_td">
                        <a class="btn btn-outline-secondary" href="/admin/galleries/{{$item->id}}">
                          <i class="fas fa-edit"></i>
                        </a>
                      </td>
                    </tr> 
                    @endforeach 
                  </tbody>
                </table> 
                @include('base.pagination')
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