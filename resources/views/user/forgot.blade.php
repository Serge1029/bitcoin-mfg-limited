@extends('layouts.front')

@section('content')

  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="pagetitle">
            {{ $langg->lang190 }}
          </h1>

          <ul class="pages">
                
              <li>
                <a href="{{ route('front.index') }}">
                  {{ $langg->lang2 }}
                </a>
              </li>
              <li>
                <a href="{{ route('user-forgot') }}">
                  {{ $langg->lang190 }}
                </a>
              </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Area End -->


    <section class="login-signup forgot-password">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-area">
                        <div class="header-area forgot-passwor-area">
                            <h4 class="title">{{ $langg->lang191 }}  </h4>
                            <p class="text">{{ $langg->lang192 }} </p>
                        </div>
                        <div class="login-form">
                            @include('includes.admin.form-login')               
                            <form id="forgotform" action="{{route('user-forgot-submit')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-input">
                                    <input type="email" name="email" class="User Name" placeholder="{{ $langg->lang193 }}" required="">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="to-login-page">
                                        <a href="{{ route('user.login') }}">
                                            {{ $langg->lang194 }}
                                        </a>
                                </div>
                                <input class="authdata" type="hidden" value="{{ $langg->lang195 }}">
                                <button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection


