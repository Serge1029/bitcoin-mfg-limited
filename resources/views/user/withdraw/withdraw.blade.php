@extends('layouts.user')


@section('content')



        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ $langg->lang336 }} <a href="{{route('user-wwt-index')}}" class="btn btn-primary btn-round ml-2">{{ $langg->lang337 }}</a>
              </h3>
            </div>


                <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                <form id="userform" class="form-horizontal px-4" action="{{route('user-wwt-store')}}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                   @include('includes.admin.form-both') 

                    <div class="row">





                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                        <select name="methods" id="withmethod" class="form-control" required>
                            <option value="">{{ $langg->lang339 }}</option>
                            <option value="Paypal">{{ $langg->lang340 }}</option>
                            <option value="Skrill">{{ $langg->lang341 }}</option>
                            <option value="Payoneer">{{ $langg->lang342 }}</option>
                            <option value="Bank">{{ $langg->lang343 }}</option>                            
                        </select>
                    </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                            <label for="amount" class="bmd-label-floating">{{ $langg->lang344 }}*</label>
                        <input name="amount" id="amount" class="form-control" autocomplete="off"  type="text" value="{{ old('amount') }}" required>
                        <span class="bmd-help">{{ $langg->lang344 }}</span>
                    </div>
                    </div>


                <div id="paypal" style="display: none; width: 100%;">

                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                            <label for="acc_email" class="bmd-label-floating">{{ $langg->lang345 }}*</label>
                        <input name="acc_email" id="acc_email" class="form-control"  type="text" value="{{ old('acc_email') }}" required>
                        <span class="bmd-help">{{ $langg->lang345 }}</span>
                    </div>
                    </div>

                </div>

                <div id="bank" style="display: none; width: 100%;">

                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                            <label for="iban" class="bmd-label-floating">{{ $langg->lang346 }}*</label>
                        <input name="iban" id="iban" class="form-control"  type="text" value="{{ old('iban') }}" required>
                        <span class="bmd-help">{{ $langg->lang346 }}</span>
                    </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                            <label for="accname" class="bmd-label-floating">{{ $langg->lang347 }}*</label>
                        <input name="accname" id="accname" class="form-control"  type="text" value="{{ old('accname') }}" required>
                        <span class="bmd-help">{{ $langg->lang347 }}</span>
                    </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                            <label for="address" class="bmd-label-floating">{{ $langg->lang348 }}*</label>
                        <input name="address" id="address" class="form-control"  type="text" value="{{ old('address') }}" required>
                        <span class="bmd-help">{{ $langg->lang348 }}</span>
                    </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                            <label for="swift" class="bmd-label-floating">{{ $langg->lang349 }}*</label>
                        <input name="swift" id="swift" class="form-control"  type="text" value="{{ old('swift') }}" required>
                        <span class="bmd-help">{{ $langg->lang349 }}</span>
                    </div>
                    </div>

                </div>


                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                            <label for="reference" class="bmd-label-floating">{{ $langg->lang350 }} </label>
                                <textarea id="reference" class="form-control" name="reference" rows="6">{{ old('reference') }}</textarea>
                        <span class="bmd-help">{{ $langg->lang350 }}</span>
                    </div>
                    </div>


                                <div id="resp" class="col-md-12">

                            <span class="help-block">
                                <strong>{{ $langg->lang351 }} ${{ $gs->withdraw_fee }} {{ $langg->lang352 }} {{ $gs->withdraw_charge }}% {{ $langg->lang353 }}</strong>
                            </span>
                                                                    </div>

                      <div class="col-lg-12">
                          <button type="submit" class="btn btn-primary btn-round">{{ $langg->lang354 }}</button>
                      </div>
                  </div>


            </form>

          </div>
        </div>


@endsection

@section('scripts')


<script type="text/javascript">
  

    $("#withmethod").change(function(){
        var method = $(this).val();
        if(method == "Bank"){

            $("#bank").show();
            $("#bank").find('input, select').attr('required',true);

            $("#paypal").hide();
            $("#paypal").find('input').attr('required',false);

        }
        if(method != "Bank"){
            $("#bank").hide();
            $("#bank").find('input, select').attr('required',false);

            $("#paypal").show();
            $("#paypal").find('input').attr('required',true);
        }
        if(method == ""){
            $("#bank").hide();
            $("#paypal").hide();
        }

    })

</script>

@endsection