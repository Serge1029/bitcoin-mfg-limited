@extends('layouts.user')


@section('content')      

        <div class="col-lg-9">
            <div class="account-box">
              <div class="header-area">
                <h4 class="title">
                    {{ $langg->lang322 }}
                </h4>

              </div>
              <div class="content">

              @include('includes.form-success') 
              @include('includes.form-error') 
                <div class="table-responsive referral">
                <table>

                  <tr class="spacer">
                    <td width="40%">
                        {{ $langg->lang323 }}
                        <br>
                        <small>{{ $langg->lang324 }}</small>
                    </td>
                    <td width="60%">
                        {{ url('/').'?reff='.$user->affilate_code}}
                    </td>
                  </tr>


                  <tr class="spacer">
                    <td width="40%">
                        {{ $langg->lang325 }}
                        <br>
                        <small>{{ $langg->lang326 }}</small>
                    </td>
                    <td width="60%">
                        <img width="100%" src="{{asset('assets/images/'.$gs->affilate_banner)}}">
                    </td>
                  </tr>


                  <tr class="spacer">
                    <td width="40%">
                        {{ $langg->lang327 }}
                        <br>
                        <small>{{ $langg->lang328 }}</small>
                    </td>
                    <td width="60%">
                        <textarea class="form-control" rows="5" name="address" disabled="" placeholder="Address *" row="5"><a href="{{ url('/').'?reff='.$user->affilate_code}}" target="_blank"><img src="{{asset('assets/images/'.$gs->affilate_banner)}}"></a></textarea>
                                                        </div>
                    </td>
                  </tr>


                </table>
                </div>
              </div>
            </div>

        </div>


@endsection

