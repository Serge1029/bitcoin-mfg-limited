@extends('layouts.admin')

@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading"> Edit Plan<a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> Back</a></h4>
											<ul class="links">
												<li>
													<a href="{{ route('admin.dashboard') }}">Dashboard </a>
												</li>
												<li>
													<a href="{{ route('admin-prod-index') }}">All Products </a>
												</li>
												<li>
													<a href="{{ route('admin-prod-edit',$data->id) }}">Edit</a>
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
					                      <form id="geniusform" action="{{route('admin-prod-update',$data->id)}}" method="POST" enctype="multipart/form-data">
					                        {{csrf_field()}}


                        						@include('includes.admin.form-both')  

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Sub Title *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="subtitle" type="text" class="input-field" placeholder="Sub Title" required="" value="{{ $data->subtitle }}">
													</div>
												</div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Title *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="title" type="text" class="input-field" placeholder="Title" required="" value="{{ $data->title }}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Minimum Price *</h4>
															<p class="sub-heading">
																(In {{ $gs->currency_code }})
															</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="min_price" type="number" min="1" class="input-field" placeholder="Minimum Price" value="{{ $data->min_price }}" required="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Maximum Price *</h4>
															<p class="sub-heading">
																(In {{ $gs->currency_code }})
															</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="max_price" type="number" min="1" class="input-field" placeholder="Maximum Price" value="{{ $data->max_price }}" required="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Days *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="days" type="number" min="1" class="input-field" value="{{ $data->days }}" placeholder="Days" required="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Payout Rate *</h4>
															<p class="sub-heading">
																(In Percentage)
															</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="percentage" type="number" min="1" class="input-field" value="{{ $data->percentage }}"  placeholder="Payout Rate should be greater than hundreed" required="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															
														</div>
													</div>
													<div class="col-lg-7 text-center">
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
