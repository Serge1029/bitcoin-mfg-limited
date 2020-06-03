		@if(count($datas) > 0)

		@foreach($datas as $data)
		@if($data->type == 'Invest')
			<a href="{{ route('user-order',$data->order_id) }}" class="dropdown-item">{{ $langg->lang75 }}</a>
		@elseif($data->type == 'Payout')
			<a href="{{ route('user-order',$data->order_id) }}" class="dropdown-item">{{ $langg->lang76 }}</a>
		@else 
			<a href="{{ route('user-wwt-index') }}" class="dropdown-item">{{ $langg->lang77 }}</a>
		@endif
		@endforeach
			<a href="javascript:;" data-href="{{ route('customer-notf-clear') }}" class="dropdown-item " id="notf-clear">{{ $langg->lang78 }}</a>		
		</ul>

		@else 
			<a class="dropdown-item ">{{ $langg->lang79 }}</a>	

		@endif


