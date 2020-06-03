@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">Facebook Login</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">Dashboard </a>
                      </li>
                      <li>
                        <a href="javascript:;">Social Settings</a>
                      </li>
                      <li>
                        <a href="{{ route('admin-social-facebook') }}">Facebook Login</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        <form action="{{ route('admin-social-update') }}" id="geniusform" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}

                        @include('includes.admin.form-both')  

                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                              <div class="left-area">
                                <h4 class="heading">
                                    Facebook Login
                                </h4>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="action-list">
                                    <select class="process select droplinks {{ $data->f_check == 1 ? 'drop-success' : 'drop-danger' }}">
                                      <option data-val="1" value="{{route('admin-social-facebookup',1)}}" {{ $data->f_check == 1 ? 'selected' : '' }}>Active</option>
                                      <option data-val="0" value="{{route('admin-social-facebookup',0)}}" {{ $data->f_check == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                  </div>
                            </div>
                          </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">App ID *</h4>
                                <p class="sub-heading">Get Your App ID from developers.facebook.com</p>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Enter App ID" name="fclient_id" value="{{ $data->fclient_id }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">App Secret *</h4>
                                <p class="sub-heading">Get Your App Secret from developers.facebook.com</p>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Enter App Secret" name="fclient_secret" value="{{ $data->fclient_secret }}" required="">
                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Website URL *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Website URL"  value="{{ url('/') }}" readonly="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Valid OAuth Redirect URI *</h4>
                                <p class="sub-heading">Copy this url and paste it to your Valid OAuth Redirect URI in developers.facebook.com.</p>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            @php
                            $url = url('/auth/facebook/callback');
                            $url = preg_replace("/^http:/i", "https:", $url);
                            @endphp
                            <input type="text" class="input-field" placeholder="Enter Site URL" name="fredirect" value="{{$url}}" readonly>
                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <button class="addProductSubmit-btn" type="submit">Save</button>
                          </div>
                        </div>
                     </form>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection