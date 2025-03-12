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
                        <form action="{{ route('admin.tokens.index_admin') }}" method="GET" enctype="multipart/form-data">@csrf
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" name="search_field" value="<?php if($search_field) { echo $search_field; }; ?>">
                              <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                              </div>
                           </div>
                        </form>
                              
                        <a class="btn btn-outline-secondary"  href="/admin/tokens/create">Opret ny</a>

                        <hr>
                        
                        <table class="table table-bordered table-sm">
                           <thead>
                              <tr>
                                 <th>Id</th>
                                 <th>Created_at</th>
                                 <th>name</th>
                                 <th>description</th>
                                 <th>token</th>                                 
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($paginator->items() as $item)
                                 <tr> 
                                    <td class="main_td">
                                       <a href="/admin/tokens/{{$item->id}}">
                                          {{ $item->id }}
                                        </a>
                                    </td>
                                
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td><a href="/{{ $item->token }}">{{ $item->token}}</a></td>
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
