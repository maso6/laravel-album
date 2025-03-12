<!DOCTYPE html>
<html lang="en"> @include('base.header') <body class="bg-gradient-primary">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-9">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-12">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">{{ env('APP_COMPANY') }} DevOps</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('login.custom') }}"> @csrf <div class="form-group mb-3">
                        <input type="text" placeholder="Email" id="email" " class=" form-control form-control-user" name="email" required autofocus> @if ($errors->has('email')) <span class="text-danger">{{ $errors->first('email') }}</span> @endif
                      </div>
                      <div class="form-group mb-3">
                        <input type="password" placeholder="Password" id="password" " class=" form-control form-control-user" name="password" required> @if ($errors->has('password')) <span class="text-danger">{{ $errors->first('password') }}</span> @endif
                      </div>
                      <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-switchpay btn-user btn-block">Login</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>