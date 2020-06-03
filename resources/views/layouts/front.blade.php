<!DOCTYPE html>
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
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/plugin.css') }}">

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/front/css/custom.css') }}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">

    <!--Updated CSS-->
  <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors)) }}">
	@yield('styles')

</head>

<body>

@if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
@endif


	<!--Top Header Area Start-->
	<div class="mainmenu-area">
		<!-- Top Header Area Start -->
		<div class="top-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="content">
							<div class="left-content">
								<p class="title">{{ $langg->lang1 }}:</p>
								<ul class="social-link">
                               	     @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                      </li>
                                      @endif
								</ul>
							</div>

							<div class="right-content">

									@if($gs->is_currency == 1)

										<div class="language-selector">
											<i class="fas fa-globe"></i>
											<select name="language" class="language selectors">
										@foreach(DB::table('languages')->get() as $language)
											<option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >{{$language->language}}</option>
										@endforeach
											</select>
										</div>

									@endif

							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Top Header Area End -->

		<div class="container">
			<div class="row">
				<div class="col-lg-12">                 
					<nav class="navbar navbar-expand-lg navbar-light">
						<a class="navbar-brand" href="{{ route('front.index') }}">
							<img src="{{ asset('assets/images/'.$gs->logo) }}" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
							aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse fixed-height" id="main_menu">
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
							</ul>
							@if(Auth::check())


							<div class="profile-area">
								<a class="profile-area-name" href="javascript:;" >

	                          @if(Auth::user()->is_provider == 1)
	                            <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png') }}" class="profile-area-img rounded-circle img-fluid">
	                          @else 
	                            <img src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo):asset('assets/images/noimage.png') }}" class="profile-area-img rounded-circle img-fluid">
	                          @endif

								{{ $langg->lang70 }}</a>
								<ul class="profile-area-content">
									<li>
										<a href="{{ route('user-dashboard') }}"><i class="fas fa-chevron-right"></i> {{ $langg->lang71 }}</a>
									</li>
									<li>
										<a href="{{ route('user-profile') }}"><i class="fas fa-chevron-right"></i>{{ $langg->lang72 }}</a>
									</li>
									<li>
										<a href="{{ route('user-reset') }}"><i class="fas fa-chevron-right"></i>{{ $langg->lang73 }}</a>
									</li>
									<li>
										<a href="{{ route('user-logout') }}"><i class="fas fa-chevron-right"></i>{{ $langg->lang74 }}</a>
									</li>
								</ul>
							</div>

							@else 
							<a href="{{ route('user.login') }}" class="mybtn1 ml-4">{{ $langg->lang69 }}</a>
							@endif

						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!--Main-Menu Area Ends-->


@yield('content')

<!-- Footer Area Start -->
<footer class="footer" id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-4">
				<div class="footer-widget about-widget">
					<div class="footer-logo">
						<a href="{{ route('front.index') }}">
							<img src="{{ asset('assets/images/'.$gs->footer_logo) }}" alt="">
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
								<button id="sub-btn" type="submit">
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
							<div class="content">
								<p>{!! $gs->copyright !!}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- Footer Area End -->

	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right"></i>
	</div>
	<!-- Back to Top End -->

<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode($gs) !!};
  var langg    = {!! json_encode($langg) !!};
</script>

	<!-- jquery -->
	<script src="{{ asset('assets/front/js/jquery.js') }}"></script>

	<!-- bootstrap -->
	<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
	<!-- popper -->
	<script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
	<!-- plugin js-->
	<script src="{{ asset('assets/front/js/plugin.js') }}"></script>
	<!-- Range Slider js-->
	<script src="{{ asset('assets/front/js/rangeslider.min.js') }}"></script>
	<!-- notify js-->
	<script src="{{ asset('assets/front/js/notify.js') }}"></script>
	<!-- main -->
	<script src="{{ asset('assets/front/js/main.js') }}"></script>
	<!-- custom -->
	<script src="{{ asset('assets/front/js/custom.js') }}"></script>

    {!! $seo->google_analytics !!}

  @if($gs->is_talkto == 1)
    <!--Start of Tawk.to Script-->
      {!! $gs->talkto !!}
    <!--End of Tawk.to Script-->
  @endif

	@yield('scripts')

</body>

</html>