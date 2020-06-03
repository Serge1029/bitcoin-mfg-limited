@extends('layouts.front')

@section('content')

  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="pagetitle">
            {{ $langg->lang30 }}
          </h1>

          <ul class="pages">
                
              <li>
                <a href="{{ route('front.index') }}">
                  {{ $langg->lang2 }}
                </a>
              </li>
              <li>
                <a href="{{ route('front.checkout',$product->id) }}">
                  {{ $langg->lang30 }}
                </a>
              </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Area End -->


<section class="order-details">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="order-details-box">
						<div class="header">
							<h4 class="title">
								{{ $langg->lang31 }}
							</h4>
						</div>
						<div class="row justify-content-between">
							<div class="col-lg-12">
								<div class="content">


									@include('includes.form-error')
									@include('includes.form-success')

									<form id="payment-form" method="POST" action="{{ route('paypal.submit') }}">

										{{ csrf_field() }}
										<div class="row">
											<div class="col-lg-12">
												<input type="text" name="customer_name" class="input-field" placeholder="{{ $langg->lang32 }}" required="" value="{{ Auth::user()->name }}">
											</div>
											<div class="col-lg-12">
												<input type="email" name="customer_email" class="input-field" placeholder="{{ $langg->lang33 }}" required="" value="{{ Auth::user()->email }}">
											</div>
											<div class="col-lg-12">
												<input type="text" name="customer_phone" class="input-field" placeholder="{{ $langg->lang34 }}" required="" value="{{ Auth::user()->phone }}">
											</div>
											<div class="col-lg-12">
												<input type="text" name="customer_address" class="input-field" placeholder="{{ $langg->lang35 }}" required="" value="{{ Auth::user()->address }}">
											</div>
											<div class="col-lg-12">
												<input type="text" name="customer_city" class="input-field" placeholder="{{ $langg->lang36 }}" required="" value="{{ Auth::user()->city }}">
											</div>
											<div class="col-lg-12">
												<input type="text" name="customer_zip" class="input-field" placeholder="{{ $langg->lang37 }}" required="" value="{{ Auth::user()->zip }}">
											</div>
											<div class="col-lg-12">
												<select class="patment-method" id="method" name="method" required="">
													@if ($gs->paypal_check)
														<option value="Paypal">{{ $langg->lang38 }}</option>
													@endif
													@if ($gs->stripe_check)
														<option value="Stripe">{{ $langg->lang39 }}</option>
													@endif
													@if ($gs->blockchain_check)
														<option value="BlockChain">{{ $langg->blockchain }}</option>
													@endif
													@if ($gs->coinpayment_check)
														<option value="CoinPayment">{{ $langg->coinpayment }}</option>
													@endif
													@if ($gs->blockio_btc)
														<option value="BlockIO(BTC)">{{ $langg->blockio_btc }}</option>
													@endif
													@if ($gs->blockio_ltc)
														<option value="BlockIO(LTC)">{{ $langg->blockio_ltc }}</option>
													@endif
													@if ($gs->blockio_dgc)
														<option value="BlockIO(DGC)">{{ $langg->blockio_dgc }}</option>
													@endif
													@if ($gs->vougepay)
														<option value="VougePay">{{ $langg->vougepay }}</option>
													@endif
													@if ($gs->coingate)
														<option value="Coingate">{{ $langg->coingate }}</option>
													@endif

											   </select>
											</div>

											<div id="card-view" class="col-lg-12 pt-3 d-none">
												<div class="row">
				                                <input type="hidden" name="cmd" value="_xclick">
				                                <input type="hidden" name="no_note" value="1">
				                                <input type="hidden" name="lc" value="UK">
				                                <input type="hidden" name="currency_code" value="{{ $gs->currency_code }}">
				                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">

											<div class="col-lg-6">

        								<input type="text" class="input-field card-elements" name="cardNumber" placeholder="{{ $langg->lang40 }}" autocomplete="off" required autofocus oninput="validateCard(this.value);"/>

												<span id="errCard"></span>

											</div>
											<div class="col-lg-6">
												<input type="text" class="input-field card-elements" placeholder="{{ $langg->lang41 }}" name="cardCVC" oninput="validateCVC(this.value);">
												<span id="errCVC"></span>
											</div>
											<div class="col-lg-6">
												<input type="text" class="input-field card-elements" placeholder="{{ $langg->lang42 }}" name="month" >
											</div>
											<div class="col-lg-6">
												<input type="text" class="input-field card-elements" placeholder="{{ $langg->lang43 }}" name="year">
											</div>
												</div>
											</div>
											<input type="hidden" name="subtitle" value="{{ $product->subtitle }}">
											<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
											<input type="hidden" name="invest" value="{{ Session::get('payprice') }}">
											<input type="hidden" name="title" value="{{ $product->title }}">
											<input type="hidden" name="details" value="{{ $product->details }}">
											<input type="hidden" name="days" value="{{ $product->days }}">
											<input type="hidden" name="total" value="{{ Session::get('getprice')}}">
											<input type="hidden" name="currency_sign" value="{{ $gs->currency_sign }}">
											<input type="hidden" name="currency_code" value="{{ $gs->currency_code }}">


{{-- 											
											<input type="hidden" name="v_merchant_id" value="DEMO" />
											<input type="hidden" name="memo" value="Order from Name Test" />
											<input type="hidden" name="cur" value="USD" />
											<input type="hidden" name="item_1" value="" />
											<input type="hidden" name="price_1" value="4" />
											<input type="hidden" name="description_1" value="" /> --}}

											<div class="col-lg-12">
												<button type="submit" class="btn-checkout">{{ $langg->lang44 }}</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 ">
					<div class="pricing">
							<div class="single-pricebox">
									<p class="plan-title">
										{{ $product->title }}
									</p>
									<div class="bonus">
										<i class="fas fa-dollar-sign"></i>
										<p class="persent">{{ $product->percentage }}%</p>
										<p class="time">{{ $langg->lang63 }} {{ $product->days }} {{ $langg->lang64 }}</p>
									</div>
									<div class="price-range-area-checkout">
										
										<div class="invest-get">
											<div class="left">
												{{ $langg->lang66 }} 
												<span>{{ $gs->currency_format == 0 ? $gs->currency_sign.Session::get('payprice') : Session::get('payprice').$gs->currency_sign }}</span>
											</div>
											<div class="right">
													{{ $langg->lang67 }} <span>{{ $gs->currency_format == 0 ? $gs->currency_sign.Session::get('getprice') : Session::get('getprice').$gs->currency_sign }}</span>
											</div>
										</div>
	

								</div>
						</div>
					</div>
							
						
			</div>
		</div>
	</section>

@endsection


@section('scripts')



<script type="text/javascript">


$('#method').on('change',function(){
	var val = $(this).val();
	if(val == 'Stripe')
	{
		$('#payment-form').prop('action','{{ route('stripe.submit') }}');
		$('#card-view').removeClass('d-none');
		$('.card-elements').prop('required',true);
	}
    if(val == 'Paypal') {
        $('#payment-form').prop('action','{{ route('paypal.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
    }
    if(val == 'BlockChain') {
        $('#payment-form').prop('action','{{ route('blockchain.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
    }
    if(val == 'CoinPayment') {
        $('#payment-form').prop('action','{{ route('coinpay.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
    }
    if(val == 'BlockIO(BTC)' || val == 'BlockIO(LTC)' || val == 'BlockIO(DGC)') {
        $('#payment-form').prop('action','{{ route('blockio.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
    }
    if(val == 'VougePay') {
        $('#payment-form').prop('action','https://voguepay.com/pay/');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
    }
    if(val == 'Coingate') {
        $('#payment-form').prop('action','{{route('coingate.submit')}}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
    }
});

$('#payment-form').on('submit',function(e){
	
	 
	var val = $('#method').val();
	if(val == 'VougePay') {
		e.preventDefault();
        $.ajax({
            type: 'post',
            url: '{{ route('vougepay.submit') }}',
            data: $('#payment-form').serialize(),
            success: function (data) {
                pay('Invest', {{ Session::get('payprice') }}, data);
				//alert(data);
            }
          });
    }else{
		$('#preloader').show();
	}


});





</script>
<script src="//voguepay.com/js/voguepay.js"></script>

<script>
    closedFunction=function() {
        alert('Payment Cancelled!');
    }

     successFunction=function(transaction_id) {
        window.location.href = '{{ url('order/payment/return') }}?txn_id=' + transaction_id;
    }

     failedFunction=function(transaction_id) {
         alert('Transaction was not successful, Ref: '+transaction_id)
    }
</script>

 <script>
    function pay(item,price,ref){
       //Initiate voguepay inline payment
        Voguepay.init({
            v_merchant_id: '{{ $gs->vouge_merchant }}',
            total: price,
            notify_url:"{{route('vougepay.notify')}}",
            cur: '{{ $gs->currency_code }}',
            merchant_ref: ref,
            memo:'Payment for '+item,
            developer_code: '5d7c87e79f555',
            store_id:'{{ Auth::user()->id }}',
            customer: {
                name: '{{ Auth::user()->name }}',
                address: '{{ Auth::user()->address }}',
                city: '{{ Auth::user()->city }}',
                zipcode: '{{ Auth::user()->zip }}',
                email: '{{ Auth::user()->email }}',
                phone: '{{ Auth::user()->phone }}'
            },
           closed:closedFunction,
           success:successFunction,
           failed:failedFunction
       });
    }

 </script>

  <script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>


  <script type="text/javascript">
    var cnstatus = false;
    var dateStatus = false;
    var cvcStatus = false;

    function validateCard(cn) {
      cnstatus = Stripe.card.validateCardNumber(cn);
      if (!cnstatus) {
        $("#errCard").html('Card number not valid<br>');
      } else {
        $("#errCard").html('');
      }
      btnStatusChange();


    }

    function validateCVC(cvc) {
      cvcStatus = Stripe.card.validateCVC(cvc);
      if (!cvcStatus) {
        $("#errCVC").html('CVC number not valid');
      } else {
        $("#errCVC").html('');
      }
      btnStatusChange();
    }

  </script>

@endsection