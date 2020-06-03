<!doctype html>
<html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}"> 
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}"> 
    @else
      <meta name="keywords" content="{{ $seo->meta_keys }}">
      <meta name="author" content="GeniusOcean">
    @endif
    <title>{{$gs->title}}</title>
  <!-- favicon -->
  <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
    <!--     Fonts and icons   -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <!-- Material Kit CSS -->
    <link href="{{asset('assets/user/css/material-kit.css?v=2.0.5')}}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/jauery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/plugins.css') }}" rel="stylesheet" />
    <!-- Main Style CSS -->
    <link href="{{ asset('assets/user/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/responsive.css') }}" rel="stylesheet" />

    <!--Updated CSS-->
  <link rel="stylesheet" href="{{ asset('assets/user/css/styles.php?color='.str_replace('#','',$gs->colors)) }}">
    
    @yield('styles')
  </head>
  <body>

  <!-- Main Menu Area Start -->
  <nav class="main-menu navbar navbar-expand-lg bg-white">
      <div class="container">
        <div class="navbar-translate">
        <a class="navbar-brand" href="{{ route('front.index') }}">
          <img src="{{ asset('assets/images/'.$gs->logo) }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        </button>
      </div>
        <div class="collapse navbar-collapse" id="main-menu">
          <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                  <a class="nav-link" href="{{ route('front.index') }}">{{ $langg->lang2 }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('front.blog') }}">{{ $langg->lang4 }}</a>
                </li>
                @if($gs->is_faq == 1)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('front.faq') }}">{{ $langg->lang5 }}</a>
                </li>
                @endif
                @if(DB::table('pages')->count() > 0)
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $langg->lang6 }}
                  </a>
                  <ul class="dropdown-menu">
                    @foreach(DB::table('pages')->orderBy('id','desc')->get() as $data)
                    <li><a class="dropdown-item" href="{{ route('front.page',$data->slug) }}"> <i class="fa fa-angle-double-right"></i>{{ $data->title }}</a></li>
                    @endforeach
                  </ul>
                </li>
                @endif
                @if($gs->is_contact == 1)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('front.contact') }}">{{ $langg->lang7 }}</a>
                </li>
                @endif
              <li  class="dropdown nav-item">
                <a href="#pablo" class="notifications dropdown-toggle nav-link" id="notf" data-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons">notifications_none</i>
                    <span  data-href="{{ route('customer-notf-count') }}" class="btn" id="notf-count">{{ App\Models\UserNotification::countNotifications(Auth::user()->id) }}</span>
                <div class="ripple-container"></div></a>
                <div class="dropdown-menu dropdown-menu-right" data-href="{{ route('customer-notf-show') }}" id="notf-show">

                </div>
              </li>
              <li class="dropdown nav-item">
                <a href="#" class="profile-photo dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
                  <div class="profile-photo-small">
                          @if(Auth::user()->is_provider == 1)
                            <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png') }}" class="rounded-circle img-fluid">
                          @else 
                            <img src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo):asset('assets/images/noimage.png') }}" class="rounded-circle img-fluid">
                          @endif

                  </div>
                  <span>{{ Auth::user()->name }}</span>
                <div class="ripple-container"></div></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="{{ route('user-profile') }}" class="dropdown-item">{{ $langg->lang72 }}</a>
                  <a href="{{ route('user-reset') }}" class="dropdown-item">{{ $langg->lang73 }}</a>
                  <a href="{{ route('user-logout') }}" class="dropdown-item">{{ $langg->lang74 }}</a>
                </div>
              </li>
          </ul> 
        </div>
      </div>
  </nav>
  <!-- Main Menu Area End -->

  <!-- Hero Area Start -->
  <div class="hero-area" style="background: url({{ asset('assets/images/'.$gs->breadcumb_banner) }});"></div>
  <!-- Hero Area End -->

  <!-- Profile Area Start -->
  <section class="profile">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="profile-image-area">
            <div class="img">
                          @if(Auth::user()->is_provider == 1)
                            <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png') }}">
                          @else 
                            <img src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo):asset('assets/images/noimage.png') }}">
                          @endif

            </div>
            <div class="content">
              <h4 class="name">
                {{ Auth::user()->name }}
              </h4>
              <p class="location">
                  <i class="material-icons">
                      location_on
                      </i> {{ Auth::user()->address }}
              </p>
            </div>
          </div>
		</div>
		<div class="col-lg-6">
			<div class="open-tikit-area">
				<div class="open-tikit">
					<a href="{{ route('user-profile') }}">
						<img src="{{ asset('assets/user/img/ticket-icon.png') }}" alt="">
					</a>
					<i class="material-icons">
							add
							</i>
				</div>
			</div>
		</div>
      </div>
    </div>
  </section>
  <!-- Profile Area End -->

  <!-- Dashbord-content Area Start -->
  <section class="dashbord-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="aside-area">
            <div class="main-menu">
              <ul class="nav">
                <li class="nav-item user-item">
                  <a href="{{ route('user-dashboard') }}" class="nav-link"><i class="material-icons">home</i>{{ $langg->lang200 }}</a>
                </li>
                <li class="nav-item user-item">
                  <a href="{{ route('user-invests') }}" class="nav-link"><i class="material-icons">list</i>{{ $langg->lang201 }}</a>
                </li>
                <li class="nav-item user-item">
                  <a href="{{ route('user-payouts') }}" class="nav-link"><i class="material-icons">collections_bookmark</i>{{ $langg->lang202 }}</a>
                </li>
               
                <li class="nav-item user-item">
                  <a href="{{ route('user-wwt-index') }}" class="nav-link"><i class="material-icons">monetization_on</i>{{ $langg->lang203 }}</a>
                </li>
                <li class="nav-item user-item">
                  <a href="{{ route('user-trans') }}" class="nav-link"><i class="material-icons">card_travel</i>{{ $langg->lang204 }}</a>
                </li> 
                <li class="nav-item user-item">
                  <a href="{{route('user.plan')}}" class="nav-link"><i class="material-icons">payment</i>{{ $langg->lang205 }}</a>
                </li>

                <li class="nav-item user-item">
                  <a href="{{ route('user-affilate-code') }}" class="nav-link"><i class="material-icons">account_balance</i>{{ $langg->lang206 }}</a>
                </li>

                <li class="nav-item user-item">
                  <a href="{{ route('user-profile') }}" class="nav-link"><i class="material-icons">person</i>{{ $langg->lang207 }}</a>
                </li>

                <li class="nav-item user-item">
                <a href="{{ route('user-reset') }}" class="nav-link"><i class="material-icons">vpn_key</i>{{ $langg->lang208 }}</a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('user-logout') }}" class="nav-link"><i class="material-icons">logout</i>{{ $langg->lang209 }}</a>
                </li>
              </ul>            
              
            </div>
            
            <div class="current-balance mt-30">
              <div class="icon-area">
                <div class="icon">
                  <img src="{{ asset('assets/user/img/balance-icon.png') }}" alt="">
                </div>
              </div>
              <div class="content">
                @if($gs->currency_format == 0)
                <p class="amount">{{ $gs->currency_sign }}{{ round(Auth::user()->income,2) }}</p>
                @else 
                <p class="amount">{{ round(Auth::user()->income,2) }}{{ $gs->currency_sign }}</p>
                @endif
                <span class="label">{{ $langg->lang210 }}</span>
              </div>
            </div>

            <a href="{{ route('user-message-index') }}" class="help-box d-block mt-30">
              <div class="icon-area">
                <div class="icon">
                  <img src="{{ asset('assets/user/img/chat-icon.png') }}" alt="">
                </div>
              </div>
              <div class="content">
                <h4 class="title">
                  {{ $langg->lang211 }}
                </h4>
                <p class="text">{{ $langg->lang212 }}</p>
              </div>
            </a>

          </div>
        </div>

        @yield('content')

      </div>
    </div>
  </section>
  <!-- Dashbord-content Area End -->

	<!-- Footer Area Start -->
<!-- Footer Area Start -->
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4">
        <div class="footer-widget about-widget">
          <div class="footer-logo">
            <a href="{{ route('front.index') }}">
              <img src="{{ asset('assets/images/'.$gs->logo) }}" alt="">
            </a>
          </div>
          <div class="text">
            <p>
              {{ $gs->footer }}
            </p>
          </div>
          
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="footer-widget address-widget">
          <h4 class="title">
            {{  $langg->lang49 }}
          </h4>
          <ul class="about-info">
            @if(App\Models\Pagesetting::find(1)->street != null)
            <li>
              <p>
                  <i class="fas fa-globe"></i>
                {{ App\Models\Pagesetting::find(1)->street }}
              </p>
            </li>
            @endif
            @if(App\Models\Pagesetting::find(1)->phone != null)
            <li>
              <p>
                  <i class="fas fa-phone"></i>
                  {{ App\Models\Pagesetting::find(1)->phone }}
              </p>
            </li>
            @endif
            @if(App\Models\Pagesetting::find(1)->email != null)
            <li>
              <p>
                  <i class="far fa-envelope"></i>
                  {{ App\Models\Pagesetting::find(1)->email }}
              </p>
            </li>
            @endif
          </ul>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
          <div class="footer-widget  footer-newsletter-widget">
            <h4 class="title">
              {{  $langg->lang50 }}
            </h4>
            <div class="newsletter-form-area">
              <form id="subscribeform" action="{{ route('front.subscribe') }}" method="POST">
                {{ csrf_field() }}
                <input type="email" id="subemail" name="email" required="" placeholder="{{ $langg->lang51 }}">
                <button class="btn" id="sub-btn" type="submit">
                  <i class="far fa-paper-plane"></i>
                </button>
              </form>
            </div>
            <div class="social-links">
              <h4 class="title">
                  {{  $langg->lang52 }}:
              </h4>
              <div class="fotter-social-links">
                                  <ul>
                                     @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                      </li>
                                      @endif
                                  </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="copy-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
              <div class="content">
                <p>{!! $gs->copyright !!}</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode($gs) !!};
</script>

<!-- Footer Area End -->

<!--   Core JS Files   -->
<script src="{{ asset('assets/user/js/core/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user/js/plugins/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/user/js/material-kit.js?v=2.0.5') }}" type="text/javascript"></script></body>
<script src="{{ asset('assets/front/js/notify.js') }}"></script>
<script src="{{ asset('assets/user/js/plugins.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/front/js/custom.js') }}" type="text/javascript"></script>
{!! $seo->google_analytics !!}

@yield('scripts')

</body>
</html>