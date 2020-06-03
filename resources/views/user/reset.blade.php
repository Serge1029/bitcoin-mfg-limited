@extends('layouts.user')
@section('content')

<div class="col-lg-9">
          <div class="transaction-area">

            <div class="heading-area">
              <h3 class="title">
                {{ $langg->lang272 }}
              </h3>
            </div>

              <form id="userform" class="px-4" action="{{route('user-reset-submit')}}">

    <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                    {{ csrf_field() }}
                    @include('includes.admin.form-both') 
                    <div class="row">
                      <div class="col-lg-12">
                            <div class="form-group bmd-form-group">
                                <label for="cpass" class="bmd-label-floating">{{ $langg->lang273 }}*</label>
                                <input type="password" class="form-control" id="cpass" name="cpass" required="">
                                <span class="bmd-help">{{ $langg->lang273 }}</span>
                            </div>
                      </div>

                      <div class="col-lg-12">
                            <div class="form-group bmd-form-group">
                                <label for="newpass" class="bmd-label-floating">{{ $langg->lang274 }}*</label>
                                <input type="password" class="form-control" id="newpass" name="newpass" required="">
                                <span class="bmd-help">{{ $langg->lang274 }}</span>
                            </div>
                      </div>

                      <div class="col-lg-12">
                            <div class="form-group bmd-form-group">
                                <label for="renewpass" class="bmd-label-floating">{{ $langg->lang275 }}*</label>
                                <input type="password" class="form-control" id="renewpass" name="renewpass" required="">
                                <span class="bmd-help">{{ $langg->lang275 }}</span>
                            </div>
                      </div>

                      <div class="col-lg-12">
                          <button type="submit" class="btn btn-primary btn-round">{{ $langg->lang276 }}</button>
                      </div>
                  </div>
              </form>
          </div>
        </div>

@endsection