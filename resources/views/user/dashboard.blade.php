@extends('layouts.user')

@section('content')

        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ $langg->lang213 }}
              </h3>
            </div>
            <div class="content">

							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ $langg->lang214 }}</th>
														<th>{{ $langg->lang215 }}</th>
														<th>{{ $langg->lang216 }}</th>
														<th>{{ $langg->lang217 }}</th>
													</tr>
												</thead>
												<tbody>

													 @foreach($user->transactions()->orderBy('id','desc')->take(5)->get() as $data)
													<tr>
														<td>
																{{$data->type}}
														</td>
														<td>
																{{ $data->txnid }}
														</td>
														<td>
															@if($gs->currency_format == 0)
																{{$gs->currency_sign}}{{ round($data->amount , 2) }}
															@else 
																{{ round($data->amount , 2) }}{{$gs->currency_sign}}
															@endif
														</td>
														<td>
																{{date('d M Y',strtotime($data->created_at))}}
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
	$('#example').DataTable();
</script>

@endsection