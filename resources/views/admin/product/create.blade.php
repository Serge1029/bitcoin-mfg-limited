@extends('layouts.admin')

@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">Add New Plan<a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> Back</a></h4>
											<ul class="links">
												<li>
													<a href="{{ route('admin.dashboard') }}">Dashboard </a>
												</li>
											<li>
												<a href="javascript:;">Pricing Plan </a>
											</li>
											<li>
												<a href="{{ route('admin-prod-create') }}">Add New Plan</a>
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
										 
					                      <form id="geniusform" action="{{route('admin-prod-store')}}" method="POST" enctype="multipart/form-data">
					                        {{csrf_field()}}

                        						@include('includes.admin.form-both')  

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Sub Title *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="subtitle" type="text" class="input-field" placeholder="Sub Title" required="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Title *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="title" type="text" class="input-field" placeholder="Title" required="">
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
														<input name="min_price" type="number" min="1" class="input-field" placeholder="Minimum Price" required="">
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
														<input name="max_price" type="number" min="1" class="input-field" placeholder="Maximum Price" required="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Days *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input name="days" type="number" min="1" class="input-field" placeholder="Days" required="">
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
														<input name="percentage" type="number" min="1" class="input-field" placeholder="Payout Rate should be greater than hundreed" required="">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															
														</div>
													</div>
													<div class="col-lg-7 text-center">
														<button class="addProductSubmit-btn" type="submit">Create Plan</button>
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