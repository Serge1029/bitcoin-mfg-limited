@extends('layouts.user')

@section('styles')
<link href="{{ asset('assets/user/css/pricing.css') }}" rel="stylesheet" />
@endsection

@section('content')

        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                Choose Your Plan
              </h3>
            </div>
            <div class="content">
<!-- Pricing Area Starts -->
    <section class="pricing">
        <div class="container">
       
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
                                {{ $gs->currency_format == 0 ? $gs->currency_sign.$prod->min_price : $prod->min_price .$gs->currency_sign }}
                                <i class="fab fa-bitcoin"></i>
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

            </div>
          </div>
        </div>

@endsection

@section('scripts')
<script src="{{ asset('assets/user/js/rangeslider.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	
</script>

@endsection
