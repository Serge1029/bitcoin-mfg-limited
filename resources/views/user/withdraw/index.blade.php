@extends('layouts.user')

@section('content')

        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ $langg->lang329 }} <a href="{{route('user-wwt-create')}}" class="btn btn-primary btn-round ml-2">{{ $langg->lang330 }}</a>
              </h3>
            </div>
            <div class="content">

							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ $langg->lang331 }}</th>
														<th>{{ $langg->lang332 }}</th>
														<th>{{ $langg->lang333 }}</th>
														<th>{{ $langg->lang334 }}</th>
														<th>{{ $langg->lang335 }}</th>
													</tr>
												</thead>
												<tbody>
                            @foreach($withdraws as $withdraw)
                                <tr>
                                    <td>{{date('d-M-Y',strtotime($withdraw->created_at))}}</td>
                                    <td>{{$withdraw->method}}</td>
                                    @if($withdraw->method != "Bank")
                                        <td>{{$withdraw->acc_email}}</td>
                                    @else
                                        <td>{{$withdraw->iban}}</td>
                                    @endif
                                    @if($gs->currency_format == 0)
                                        <td>{{$gs->currency_sign}}{{ round($withdraw->amount, 2) }}</td>
                                    @else 
                                        <td>{{ round($withdraw->amount, 2) }}{{$gs->currency_sign}}</td>
                                    @endif
                                    <td>{{ucfirst($withdraw->status)}}</td>
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

