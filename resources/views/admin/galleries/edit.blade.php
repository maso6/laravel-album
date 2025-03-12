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
                <div class="row">
                  <div class="col-md-6">
                    {{ html()->form('POST')->acceptsFiles()->route('admin.galleries.update', $gallery['id'])->open() }}
                    <input name="id" type="hidden" value="{{$gallery['id']}}">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <strong>Title:</strong>
                          <input type="text" class="form-control" name="title" value="{{ $gallery['title'] }}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <strong>Description:</strong>
                          <input type="text" class="form-control" name="description" value="{{ $gallery['description'] }}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <strong>Image:</strong>
                          <br>
                          <img src="data:image/png;base64, {{ $gallery['image'] }}" width="50px" />
                          </br>
                          <input name="newimage" class="form-control" type="file" id="newimage">
                          <input name="image" type="hidden" value="{{$gallery['image']}}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                            <a class="btn btn-outline-danger btn-user" href="/admin/galleries/{{$gallery['id']}}/delete"><i class="fa-solid fa-trash"></i></a>
                             <button type="submit" class="btn btn-outline-primary btn-user"><i class="fa-solid fa-floppy-disk"></i></button>
                        </div>
                      </div>
                    </div>
                    {{ html()->form()->close() }}
                  </div>
                  <div class="col-md-6">
                    {{ html()->form('POST')->route('admin.tokens.updategallery')->open() }}
                    <input name="gallery_id" type="hidden" value="{{$gallery['id']}}">
                    <div class="col-md-12">
                      <div class="form-group">
                        <strong>Token adgange:</strong>
                        <select name="tokens[]" class="form-control" multiple> 
                            @foreach ($tokens as $token ) 
                            <option value="{{ $token->id }}" <?php if($token->active) { echo "selected=true";};?>>{{ $token->name }} ({{ $token->token }}) </option> 
                            @endforeach 
                        </select>
                      </div>
                      <button type="submit" class="btn btn-outline-secondary"><i class="fa-solid fa-floppy-disk"></i></button>

                    </div>
                    {{ html()->form()->close() }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <hr>
                    <a class="btn btn-outline-secondary" href="/admin/images/create/{{$gallery['id']}}">Opret nyt billede</a>
                    <br>
                    <br>
                    <table class="table table-bordered table-sm">
                      <thead>
                        <tr>
                          <th>Created_at</th>
                          <th>description</th>
                          <th>Image</th>
                          <th>Rediger</th>
                        </tr>
                      </thead>
                      <tbody> @foreach($paginator->items() as $item) <tr>
                          <td>{{ $item->created_at }}</td>
                          <td>{{ $item->description }}</td>
                          <td>
                            <img src="data:image/png;base64, {{ $item['image'] }}" width="100px" />
                          </td>
                          <td class="main_td">
                            <a class="btn btn-outline-secondary" href="/admin/images/{{$item->id}}">
                              <i class="fas fa-edit"></i>
                            </a>
                          </td>
                        </tr> @endforeach </tbody>
                    </table> @include('base.pagination')
                  </div>
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