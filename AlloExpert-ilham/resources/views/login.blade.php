@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section style="margin-top: -190px; box-shadow: 0 0 15px rgba(197, 188, 188, 0.5);
    border-radius:1%;">
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info" style="color: #ff5e14 !important">Welcome back</h3>
                  <p class="mb-0">dear <br></p>
                  <p class="mb-0"></p>
                  <p class="mb-0"></p>
                  <p class="mb-0"></p>
                </div>
                @if (Session::has('errorLogin'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('errorLogin') }}
                                    </div>
                                @elseif (Session::has('successLoginClient'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('successLoginClient') }}
                                    </div>
                                    @elseif (Session::has('successLoginPartenaire'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('successLoginPartenaire') }}
                                        </div>
                                    @endif
                <div class="card-body">
                  <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <label>Email</label>
                    <div class="mb-3">
                      <label for="email"></label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="admin@softui.com" aria-label="Email" aria-describedby="email-addon">
                      @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <label for="password"></label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="secret" aria-label="Password" aria-describedby="password-addon">
                      @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                  
                    <div class="text-center">
                      <button type="submit" class="btn w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="register" class="text-info  font-weight-bold" style="color: #ff5e14 !important">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection