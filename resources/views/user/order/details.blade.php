@extends('layouts.user')

@section('content')

        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ $langg->lang226 }} <a href="javascript:history.back();" class="btn btn-round btn-base ml-2">{{ $langg->lang227 }}</a>
              </h3>
            </div>
            <div class="content">

                            <div class="mr-table allproduct mt-4">
                                    <div class="table-responsiv">
                                        <table class="table">
                                            <tr>
                                                <th width="50%">{{ $langg->lang228 }}</th>
                                                <td>{{$order->order_number}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ $langg->lang229 }}</th>
                                                <td>{{$order->title}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ $langg->lang230 }}</th>
                                                <td>{{$order->method}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ $langg->lang231 }}</th>
                                                <td>{{$order->invest}}{{ $gs->currency_sign }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ $langg->lang232 }}</th>
                                                <td>{{$order->pay_amount}}{{ $gs->currency_sign }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{$order->method}} {{ $langg->lang233 }}</th>
                                                <td>{{$order->txnid}}</td>
                                            </tr>

                                            @if($order->method != 'Paypal')
                                            <tr>
                                                <th>{{$order->method}} {{ $langg->lang234 }}</th>
                                                <td>{{$order->method}} {{$order->charge_id}}</td>
                                            </tr>
                                            @endif

                                            <tr>
                                                <th>{{ $langg->lang235 }}</th>
                                                <td>{{$order->payment_status}}</td>
                                            </tr>


                                            <tr>
                                                <th>{{ $langg->lang236 }}</th>
                                                <td>{{$order->created_at}}</td>
                                            </tr>


                                            
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
