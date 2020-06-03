@extends('layouts.front') 

@section('content')

	<!-- Hero Area Start -->
	<section class="hero-area" style="background: url({{ $gs->banner ? asset('assets/images/'.$gs->banner):asset('assets/images/noimage.png') }});">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
						<div class="content">
							{!! $ps->banner_title !!}
							{!! $ps->banner_text!!}
							@if($ps->banner_link1 != null)
								<a href="{{ $ps->banner_link1 }}" class="mybtn1 left"><span>{{ $langg->lang8 }}
									</span></a>
							@endif
							@if($ps->banner_link2 != null)
							<a href="{{ $ps->banner_link2 }}" class="mybtn1 right"><span>{{ $langg->lang54 }}
								</span></a>
							@endif
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero Area End -->

	@if($ps->slider == 1)
	<!-- Features Area Start-->
	<section class="features">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="feature-area">
						<div class="row">

						@foreach($services as $service)	
							<div class="col-lg-3 col-md-6 padding-zero br-r">
								<div class="single-feature">
									<div class="icon">
										<img src="{{ asset('assets/images/services/'.$service->photo) }}" alt="">
									</div>
									<h4 class="title">
										{{ $service->title }}
									</h4>
								</div>
							</div>
						@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features Area End-->
	@endif

	@if($ps->service == 1)
	<!-- About Area Start-->
	<section class="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="about-img">
						<img src="{{ asset('assets/images/'.$gs->service_image) }}" alt="">
					</div>
				</div>
				<div class="col-lg-6 d-flex align-self-center">
					<div class="about-content">
							<div class="section-heading">
									<h5 class="sub-title">
											{!! $gs->service_subtitle !!}
									</h5>
									<h2 class="title extra-padding">
										{!! $gs->service_title !!}
									</h2>
								</div>
								<div class="content">
									{!! $gs->service_text !!}
									<a href="https://mfg-limited.com/about" class="mybtn1">{{ $langg->lang9 }}</a>
								</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features Area End-->

	@endif

	@if($ps->pricing_plan == 1)

	<!-- Service Area Start -->
	<section class="service">
		<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-10">
				<div class="section-heading">
					<h5 class="sub-title">
							{{ $ps->service_subtitle }}
					</h5>
					<h2 class="title">
							{{ $ps->service_title }}
					</h2>
					<p class="text">
							{{ $ps->service_text }}  
					</p>
				</div>
			</div>
		</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="service-slider">
						@foreach($features as $data)
						<div class="item">
							<div class="single-service">
								<div class="icon">
									<img src="{{ asset('assets/images/features/'.$data->photo) }}" alt="">
								</div>
								<div class="content">
									<h4 class="title">
											{{ $data->title }}
									</h4>
									<p>
										{!! $data->details !!}
									</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Service Area End -->

	@endif

	@if($ps->top_rated == 1)

	<!-- Submit Address Area Start -->
	<div class="submit-address">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="submit-address-inner" style="background: url({{ asset('assets/images/'.$ps->c_background) }});">
						<h4 class="title">
							{{ $ps->c_title }}
						</h4>
						<div class="submit-form">
							<a href="https://mfg-limited.com/user/login" class="mybtn2">{{ $langg->lang55 }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Submit Address Area End -->

	@endif

	@if($ps->large_banner == 1)

	<!-- Latest Transactions Area Start -->
	<section class="transactions" id="invest">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="sub-title">
							{{ $ps->t_subtitle }}
						</h5>
						<div class="title-big">
							{{ $ps->t_big_title }}
						</div>
						<h2 class="title">
							{{ $ps->t_subtitle }}
						</h2>
						<p class="text">
							{{ $ps->t_text }}
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="transaction-table">
						<div class="responsive-table">
							<table class="table">
								<thead>
									<tr>
									<th scope="col">{{ $langg->lang56 }}</th>
									<th scope="col">{{ $langg->lang57 }}</th>
									<th scope="col">{{ $langg->lang58 }}</th>
									<th scope="col">{{ $langg->lang59 }}</th>
									<th scope="col">{{ $langg->lang60 }}</th>
									</tr>
								</thead>
								<tbody>

									@foreach(App\Models\Order::where('status','!=','declined')->where('payment_status','=','Completed')->orderBy('id','desc')->take(8)->get() as $order)

									<tr>
										<td>
											@if($order->status == 'pending')
											{{ $langg->lang61 }}
											@else 
											{{ $langg->lang62 }} 
											@endif
										</td>
										<td>
											{{ date('Y-m-d',strtotime($order->created_at)) }}
										</td>
										<td>
															@if($gs->currency_format == 0)
																{{ $gs->currency_sign }}{{ round($order->invest , 2) }}
															@else 
																{{ round($order->invest , 2) }}{{ $gs->currency_sign }}
															@endif
										</td>
										<td class="countdown" data-date="{{ Carbon\Carbon::parse($order->end_date)->format('M d,Y h:i:s') }}">




										</td>
										<td>
															@if($gs->currency_format == 0)
																{{ $gs->currency_sign }}{{ round($order->pay_amount , 2) }}
															@else 
																{{ round($order->pay_amount , 2) }}{{ $gs->currency_sign }}
															@endif
										</td>
									</tr>


									@endforeach

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Latest Transactions Area End -->

	@endif

	@if($ps->big == 1)

<!-- Testimonial Area Start -->
<section class="testimonial">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10">
				<div class="section-heading color-white">
						<h5 class="sub-title">
								{{ $ps->review_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->review_title }}
						</h2>
						<p class="text">
								{{ $ps->review_text }} 
						</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-10">
				<div class="testimonial-slider">

					@foreach($reviews as $review)

					<div class="single-testimonial">
							<div class="review-text">
								<p>{{ $review->details }}</p>
							</div>
							<div class="people">
								<div class="img">
										<img src="{{ asset('assets/images/reviews/'.$review->photo) }}" alt="">
								</div>
								<h4 class="title">{{ $review->title }}</h4>
								<p class="designation">{{  $review->subtitle }}</p>
							</div>
					</div>

					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>
<!-- Testimonial Area End -->

	@endif

	@if($ps->hot_sale == 1)


	<!-- Pricing Area Starts -->
<section class="pricing">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading">
						<h5 class="sub-title">
							{{ $gs->price_subtitle }}
						</h5>
						<div class="title-big">
							{{ $gs->price_bigtitle }}
						</div>
						<h2 class="title">
							{{ $gs->price_title }}
						</h2>
						<p class="text">
							{{ $gs->price_text }}
						</p>
					</div>
				</div>
			</div>
			<div class="row">


		@foreach($products as $prod)

				<div class="col-lg-4 col-md-6">
					<div class="single-pricebox">
						<p class="plan-title">
							{{ $prod->title }}
						</p>
						<div class="bonus">
							<i class="fas fa-dollar-sign"></i>
							<p class="persent">{{ $prod->percentage }}%</p>
							<p class="time">{{ $langg->lang62 }} {{ $prod->days }} {{ $langg->lang64 }} </p>
						</div>
						<div class="price-range-area">
							<div class="invest-count">
								<div class="left">
									{{ $langg->lang65 }} 
								</div>
								<div class="right">
									{{ $gs->currency_format == 0 ? $gs->currency_sign.$prod->min_price : $prod->min_price .$gs->currency_sign }}<i class="fab fa-bitcoin"></i>
								</div>
							</div>
							<div class="invest-range-slider">
								<div class="range-slider">
									<input class="range-slider__range" type="range" value="{{ $prod->min_price }}" min="{{ $prod->min_price }}" max="{{ $prod->max_price }}" style="background: linear-gradient(90deg, rgb(31, 113, 212) 26.4%, rgba(31, 113, 212, 0.125) 26.5%);">
								</div> 
							</div>
							<div class="invest-get">
								<div class="left">
									{{ $langg->lang66 }}  <br>
									<input type="hidden" value="{{ $prod->min_price }}" class="invest-min-price" />
									<input type="hidden" value="{{ round($prod->max_price ) }}" class="invest-max-price" />
									<input type="number" min="{{ $prod->min_price }}" max="{{ round($prod->max_price ) }}"  class="payprice" value="{{ $prod->min_price }}">
									<span style="display:none;" class="range-slider__value ck">{{ $prod->min_price }}</span>
								</div>
								<input type="hidden" class="dbl" value="{{ $prod->interest() }}">
								<div class="right">
									{{ $langg->lang67 }}  <span class="dk">{{ round($prod->min_price * $prod->interest()) }}</span>
									<input type="hidden" class="prodid" value="{{ $prod->id }}">
									<input type="hidden" class="getprice" value="{{ round($prod->min_price * $prod->interest()) }}">
								</div>
							</div>
						</div>
						<div class="invest-button">
							<a href="javascript:;" data-url="{{ route('front.setdata') }}" data-href="{{ route('front.checkout',$prod->id) }}" class="mybtn1 checkout-btn">{{ $langg->lang68 }} </a>
						</div>
					</div>
				</div>

		@endforeach
			
			</div>
		</div>
	</section>
	<!-- Pricing Area Ends -->

	@endif


	@if($ps->review_blog == 1)


<!-- Blog Area Start -->
<section class="blog">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10">
				<div class="section-heading">
						<h5 class="sub-title">
								{{ $ps->blog_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->blog_title }}
						</h2>
						<p class="text">
								{{ $ps->blog_text }} 
						</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="blog-slider">

					@foreach($lblogs as $blog)

					<div class="single-blog">
						<div class="img">
							<img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
						</div>
						<div class="content">
							<h4 class="title">
								{{ $blog->title }}
							</h4>
							<ul class="top-meta">
								<li>
									<a href="{{ route('front.blogshow',$blog->id) }}">
											<i class="far fa-calendar"></i> {{  date('d M, Y',strtotime($blog->created_at)) }}
									</a>
								</li>
								<li>
									<a href="{{ route('front.blogshow',$blog->id) }}">
											<i class="far fa-eye"></i> {{ $blog->views }}
									</a>
								</li>
							</ul>
							<div class="text">
								<p>
									{{substr(strip_tags($blog->details),0,120)}}
								</p>
							</div>
							<a href="{{ route('front.blogshow',$blog->id) }}" class="link">{{ $langg->lang9 }} <i class="fas fa-chevron-right"></i></a>
						</div>
					</div>

					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Blog Area End -->

	@endif


@endsection


@section('scripts')


<script type="text/javascript">

	{{--@if(app('request')->input('section') != "")--}}

    {{--$(document).ready(function () {--}}
        {{--// Handler for .ready() called.--}}
        {{--$('html, body').animate({--}}
            {{--scrollTop: $("#{{app('request')->input('section')}}").offset().top--}}
        {{--}, 'slow');--}}
    {{--});--}}
    {{--@endif--}}


	$('.countdown').each(function(){
		var date = $(this).data('date');
		var countDownDate = new Date(date).getTime();
		var $this = $(this);
		var x = setInterval(function() {
		  // Get today's date and time
		  var now = new Date().getTime();

		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;

		  // Time calculations for days, hours, minutes and seconds
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		  // Display the result in the element with id="demo"
		  var text = days + "d " + hours + "h "
		  + minutes + "m " + seconds + "s ";
		  $this.html(text);

		  // If the count down is finished, write some text 
		  if (distance < 0) {
		    clearInterval(x);
		   var text = 0 + "d " + 0 + "h "
		  + 0 + "m " + 0 + "s ";
		  $this.html(text);
		  }
		}, 1000);
	});


</script>


@endsection