@extends('layouts.admin') 

@section('content')
                    <div class="content-area">
                @include('includes.form-success')
                @if($activation_notify != "")
                    <div class="alert alert-danger validation">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h3 class="text-center">{!! $activation_notify !!}</h3>
                    </div>
                @endif
                        <div class="row row-cards-one">
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg1">
                                        <div class="left">
                                            <h5 class="title">Pending Investments! </h5>
                                            <span class="number">{{count($pending)}}</span>
                                            <a href="{{route('admin-order-pending')}}" class="link">View All</a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg3">
                                        <div class="left">
                                            <h5 class="title">Completed Investments!</h5>
                                            <span class="number">{{count($completed)}}</span>
                                            <a href="{{route('admin-order-completed')}}" class="link">View All</a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-check-circled"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg4">
                                        <div class="left">
                                            <h5 class="title">Total Pricing Plans!</h5>
                                            <span class="number">{{count($products)}}</span>
                                            <a href="{{route('admin-prod-index')}}" class="link">View All</a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-cart-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg6">
                                        <div class="left">
                                            <h5 class="title">Total Posts!</h5>
                                            <span class="number">{{count($blogs)}}</span>
                                            <a href="{{ route('admin-blog-index') }}" class="link">View All</a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-newspaper"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                    </div>

@endsection
