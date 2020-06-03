@extends('layouts.user')

@section('content')

        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ $langg->lang219 }}
              </h3>
            </div>
            <div class="content">

							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ $langg->lang220 }}</th>
														<th>{{ $langg->lang221 }}</th>
														<th>{{ $langg->lang500 }}</th>
														<th>{{ $langg->lang224 }}</th>
														<th></th>
													</tr>
												</thead>
												<tbody>

												@foreach($orders as $data)
													<tr>
														<td>
																{{ $data->title }}
														</td>
														<td>
																{{ $data->method }}
														</td>
														<td>
															@if($gs->currency_format == 0)
																{{ $gs->currency_sign }}{{ round($data->invest , 2) }}
															@else 
																{{ round($data->invest , 2) }}{{ $gs->currency_sign }}
															@endif
														</td>
														<td>
															@if($gs->currency_format == 0)
																{{ $gs->currency_sign }}{{ round($data->pay_amount , 2) }}
															@else 
																{{ round($data->pay_amount , 2) }}{{ $gs->currency_sign }}
															@endif
														</td>
														<td>
															<a href="{{ route('user-order',$data->id) }}">
															{{ $langg->lang225 }}
															</a>
														</td>

													</tr>
												@endforeach

												</tbody>
											</table>
									</div>
								</div>

            </div>
          </div>
        </div>

@endsection

@section('scripts')

<script type="text/javascript">
	$('#example').DataTable({
		ordering: false
	});
</script>

@endsection
