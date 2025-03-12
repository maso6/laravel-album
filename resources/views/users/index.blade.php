

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
                    <h1 class="h3 mb-2 text-gray-800">Brugerstyring</h1>
                    <p class="mb-4">
                      Herunder kan de se hvilke bruger der har adgang til systemet samt hvilke roller de er tildelt, og få en oversigt over deres aktiviteter og tilladelser i systemet.
                    </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Brugerstyring</h6>
                        </div>
            
                        <div class="card-body">

                            <a href="{{ route('users.create') }}" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Opret ny bruger</span>
                            </a>
                            <br>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                        <th>Navn</th>
                                        <th>E mail</th>
                                        <th>Rolle</th>
                                        <th>Rediger</th>
                                        <th>Slet</th>

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
                                          
                                        <td><a class="btn btn-light btn-block" href="{{ route('users.edit',$user->id) }}">Rediger</a></td>
                                            
                                        <td>
                                          @can('user-delete')

                                            {{ html()->form('DELETE')->route('users.destroy', $user->id)->open() }}
                                                <button type="submit" class="btn btn-danger btn-block">Slet</button>
                                            {{ html()->form()->close() }}
                                           
                                          @endcan
                                        </td>
                                        </tr>
                                       
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
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



