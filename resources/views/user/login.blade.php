@extends('layouts.front')
@section('content')


  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="pagetitle">
            {{ $langg->lang171 }}
          </h1>

          <ul class="pages">
                
              <li>
                <a href="{{ route('front.index') }}">
                  {{ $langg->lang2 }}
                </a>
              </li>
              <li>
                <a href="{{ route('user.login') }}">
                  {{ $langg->lang171 }}
                </a>
              </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Area End -->

<!-- login-signup Area Start -->
<section class="login-signup">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="log-reg-tab-wrapper">
          <div class="log-reg-tab-menu">
            <ul class="nav" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab" aria-controls="pills-signup" aria-selected="true">{{ $langg->lang172 }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                  {{ $langg->lang181 }}
                </a>
              </li>
            </ul>
          </div>
          <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">

              <div class="login-area signup-area">  
                  <div class="login-form signup-form">
                    <form id="loginform" action="{{ route('user.login.submit') }}" method="POST">
                      @include('includes.admin.form-login')
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-input">
                            <input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
                            <i class="fas fa-envelope"></i>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-input">
                            <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}" required="">
                            <i class="fas fa-key"></i>
                          </div>
                        </div>
                      </div>
                      <a href="{{ route('user-forgot') }}" class="forgot-pass">{{ $langg->lang176 }} </a>
                      <input id="authdata" type="hidden" value="{{ $langg->lang177 }}">
                      <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
                        @if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check == 1)
                        <div class="social-area">
                            <h3 class="title">{{ $langg->lang179 }}</h3>
                            <p class="text">{{ $langg->lang180 }}</p>
                            <ul class="social-links">
                              @if(App\Models\Socialsetting::find(1)->f_check == 1)
                              <li>
                                <a href="{{ route('social-provider','facebook') }}"> 
                                  <i class="fab fa-facebook-f"></i>
                                </a>
                              </li>
                              @endif
                              @if(App\Models\Socialsetting::find(1)->g_check == 1)
                              <li>
                                <a href="{{ route('social-provider','google') }}">
                                  <i class="fab fa-google-plus-g"></i>
                                </a>
                              </li>
                              @endif
                            </ul>
                        </div>
                        @endif

                      
                    </form>
                  </div>
                </div>


          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

              <div class="login-area signup-area">
                  <div class="login-form signup-form">
                    <form id="registerform" action="{{route('user-register-submit')}}" method="POST">
                       @include('includes.admin.form-login')
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="form-input">
                                <input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required="">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="form-input">
                                <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="form-input">
                                <input type="tel" class="User Name" name="phone" placeholder="{{ $langg->lang184 }}" required="">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="form-input">
                                <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="form-input">
                                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="form-input">
                                <input type="password" class="Password" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="form-input">
                                <input type="text" class="Password" autocomplete="off"  placeholder="{{ $langg->lang27 }}" name="codes" required="">
                                <i class="fas fa-code"></i>
                              </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                            <ul class="captcha-area">
                              <li>
                                <p><img class="codeimg" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i data-href="{{url('contact/refresh_code')}}" class="fas fa-sync-alt pointer refresh_code "></i></p>
                              </li>
                            </ul>
                        </div>
                      </div>
                      <input id="processdata" type="hidden" value="{{ $langg->lang188 }}">
                      <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>
                    </form>
                  </div>
                </div>

          </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</section>

<!-- login-signup Area Ends -->
@endsection