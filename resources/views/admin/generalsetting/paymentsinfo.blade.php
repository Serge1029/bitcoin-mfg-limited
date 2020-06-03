@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">Payment Informations</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">Dashboard </a>
                      </li>
                      <li>
                        <a href="javascript:;">Payment Settings</a>
                      </li>
                      <li>
                        <a href="{{ route('admin-gs-payments') }}">Payment Informations</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content social-links-area">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        <form action="{{ route('admin-gs-update') }}" id="geniusform" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}

                        @include('includes.admin.form-both')  



                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                              <div class="left-area">
                                <h4 class="heading">
                                    Paypal
                                </h4>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="action-list">
                                    <select class="process select droplinks {{ $gs->paypal_check == 1 ? 'drop-success' : 'drop-danger' }}">
                                      <option data-val="1" value="{{route('admin-gs-paypal',1)}}" {{ $gs->paypal_check == 1 ? 'selected' : '' }}>Activated</option>
                                      <option data-val="0" value="{{route('admin-gs-paypal',0)}}" {{ $gs->paypal_check == 0 ? 'selected' : '' }}>Deactivated</option>
                                    </select>
                                  </div>
                            </div>
                          </div>                          


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Paypal Business Email *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Paypal Business Email" name="paypal_business" value="{{ $gs->paypal_business }}" required="">
                          </div>
                        </div>
<hr>

                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <div class="left-area">
                                        <h4 class="heading">
                                            Stripe
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="action-list">
                                        <select class="process select droplinks {{ $gs->stripe_check == 1 ? 'drop-success' : 'drop-danger' }}">
                                            <option data-val="1" value="{{route('admin-gs-stripe',1)}}" {{ $gs->stripe_check == 1 ? 'selected' : '' }}>Activated</option>
                                            <option data-val="0" value="{{route('admin-gs-stripe',0)}}" {{ $gs->stripe_check == 0 ? 'selected' : '' }}>Deactivated</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Stripe Key *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Stripe Key" name="stripe_key" value="{{ $gs->stripe_key }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Stripe Secret *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Stripe Secret" name="stripe_secret" value="{{ $gs->stripe_secret }}" required="">
                          </div>
                        </div>
<hr>

                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <div class="left-area">
                                        <h4 class="heading">
                                            BlockChain
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="action-list">
                                        <select class="process select droplinks {{ $gs->blockchain_check == 1 ? 'drop-success' : 'drop-danger' }}">
                                            <option data-val="1" value="{{route('admin-gs-blockchain',1)}}" {{ $gs->blockchain_check == 1 ? 'selected' : '' }}>Activated</option>
                                            <option data-val="0" value="{{route('admin-gs-blockchain',0)}}" {{ $gs->blockchain_check == 0 ? 'selected' : '' }}>Deactivated</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Any Secret String *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Any Secret String" name="secret_string" value="{{ $gs->secret_string }}" required="">
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">BlockChain xPub *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="BlockChain xPub" name="blockchain_xpub" value="{{ $gs->blockchain_xpub }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">BlockChain API Key *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="BlockChain API Key" name="blockchain_api" value="{{ $gs->blockchain_api }}" required="">
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">BlockChain Gap Limit *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="BlockChain Gap Limit" name="gap_limit" value="{{ $gs->gap_limit }}" required="">
                          </div>
                        </div>
<hr>

                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <div class="left-area">
                                        <h4 class="heading">
                                            CoinPayment (BTC)
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="action-list">
                                        <select class="process select droplinks {{ $gs->coinpayment_check == 1 ? 'drop-success' : 'drop-danger' }}">
                                            <option data-val="1" value="{{route('admin-gs-coinpayment',1)}}" {{ $gs->coinpayment_check == 1 ? 'selected' : '' }}>Activated</option>
                                            <option data-val="0" value="{{route('admin-gs-coinpayment',0)}}" {{ $gs->coinpayment_check == 0 ? 'selected' : '' }}>Deactivated</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">CoinPayment Public Key *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="CoinPayment Public Key" name="coin_public_key" value="{{ $gs->coin_public_key }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">CoinPayment Private Key *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="CoinPayment Private Key" name="coin_private_key" value="{{ $gs->coin_private_key }}" required="">
                          </div>
                        </div>
<hr>
                      <div class="row justify-content-center">
                          <div class="col-lg-3">
                              <div class="left-area">
                                  <h4 class="heading">
                                    Block.io Bitcoin (BTC)
                                  </h4>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="action-list">
                                  <select class="process select droplinks {{ $gs->blockio_btc == 1 ? 'drop-success' : 'drop-danger' }}">
                                      <option data-val="1" value="{{route('admin-gs-gatewaysts', ['status'=>1, 'column'=>'blockio_btc'])}}" {{ $gs->blockio_btc == 1 ? 'selected' : '' }}>Activated</option>
                                      <option data-val="0" value="{{route('admin-gs-gatewaysts', ['status'=>0, 'column'=>'blockio_btc'])}}" {{ $gs->blockio_btc == 0 ? 'selected' : '' }}>Deactivated</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-lg-3">
                          <div class="left-area">
                              <h4 class="heading">Block.io API Key (BTC) *
                                </h4>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <input type="text" class="input-field" placeholder="Block.io API Key (BTC)" name="blockio_api_btc" value="{{ $gs->blockio_api_btc }}" required="">
                        </div>
                      </div>

<hr>
                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">
                                  Block.io Litecoin (LTC)
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="action-list">
                                <select class="process select droplinks {{ $gs->blockio_ltc == 1 ? 'drop-success' : 'drop-danger' }}">
                                    <option data-val="1" value="{{route('admin-gs-gatewaysts', ['status'=>1, 'column'=>'blockio_ltc'])}}" {{ $gs->blockio_ltc == 1 ? 'selected' : '' }}>Activated</option>
                                    <option data-val="0" value="{{route('admin-gs-gatewaysts', ['status'=>0, 'column'=>'blockio_ltc'])}}" {{ $gs->blockio_ltc == 0 ? 'selected' : '' }}>Deactivated</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-3">
                        <div class="left-area">
                            <h4 class="heading">Block.io Litecoin API Key (LTC) *
                              </h4>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <input type="text" class="input-field" placeholder="Block.io API Key (LTC)" name="blockio_api_ltc" value="{{ $gs->blockio_api_ltc }}" required="">
                      </div>
                    </div>

<hr>
                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">
                                  Block.io Dogecoin (DGC)
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="action-list">
                                <select class="process select droplinks {{ $gs->blockio_dgc == 1 ? 'drop-success' : 'drop-danger' }}">
                                    <option data-val="1" value="{{route('admin-gs-gatewaysts', ['status'=>1, 'column'=>'blockio_dgc'])}}" {{ $gs->blockio_dgc == 1 ? 'selected' : '' }}>Activated</option>
                                    <option data-val="0" value="{{route('admin-gs-gatewaysts', ['status'=>0, 'column'=>'blockio_dgc'])}}" {{ $gs->blockio_dgc == 0 ? 'selected' : '' }}>Deactivated</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-3">
                        <div class="left-area">
                            <h4 class="heading">Block.io Dogecoin API Key (DGC) *
                              </h4>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <input type="text" class="input-field" placeholder="Block.io API Key (DGC)" name="blockio_api_dgc" value="{{ $gs->blockio_api_dgc }}" required="">
                      </div>
                    </div>

<hr>
                  <div class="row justify-content-center">
                      <div class="col-lg-3">
                          <div class="left-area">
                              <h4 class="heading">
                                VougePay
                              </h4>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="action-list">
                              <select class="process select droplinks {{ $gs->vougepay == 1 ? 'drop-success' : 'drop-danger' }}">
                                  <option data-val="1" value="{{route('admin-gs-gatewaysts', ['status'=>1, 'column'=>'vougepay'])}}" {{ $gs->vougepay == 1 ? 'selected' : '' }}>Activated</option>
                                  <option data-val="0" value="{{route('admin-gs-gatewaysts', ['status'=>0, 'column'=>'vougepay'])}}" {{ $gs->vougepay == 0 ? 'selected' : '' }}>Deactivated</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-lg-3">
                      <div class="left-area">
                          <h4 class="heading">VougePay Merchant ID *
                            </h4>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <input type="text" class="input-field" placeholder="VougePay Merchant ID" name="vouge_merchant" value="{{ $gs->vouge_merchant }}" required="">
                    </div>
                  </div>

<hr>
              <div class="row justify-content-center">
                  <div class="col-lg-3">
                      <div class="left-area">
                          <h4 class="heading">
                            CoinGate
                          </h4>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="action-list">
                          <select class="process select droplinks {{ $gs->coingate == 1 ? 'drop-success' : 'drop-danger' }}">
                              <option data-val="1" value="{{route('admin-gs-gatewaysts', ['status'=>1, 'column'=>'coingate'])}}" {{ $gs->coingate == 1 ? 'selected' : '' }}>Activated</option>
                              <option data-val="0" value="{{route('admin-gs-gatewaysts', ['status'=>0, 'column'=>'coingate'])}}" {{ $gs->coingate == 0 ? 'selected' : '' }}>Deactivated</option>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-lg-3">
                  <div class="left-area">
                      <h4 class="heading">Coingate AUTH *
                        </h4>
                  </div>
                </div>
                <div class="col-lg-6">
                  <input type="text" class="input-field" placeholder="Coingate AUTH" name="coingate_auth" value="{{ $gs->coingate_auth }}" required="">
                </div>
              </div>

<hr>
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Currency Format *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <select name="currency_format" required="">
                                  <option value="0" {{ $gs->currency_format == 0 ? 'selected' : '' }}>Before Price</option>
                                  <option value="1" {{ $gs->currency_format == 1 ? 'selected' : '' }}>After Price</option>
                              </select>
                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Withdraw Fee *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Withdraw Fee" name="withdraw_fee" value="{{ $gs->withdraw_fee }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">Withdraw Charge(%) *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="Withdraw Charge(%)" name="withdraw_charge" value="{{ $gs->withdraw_charge }}" required="">
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