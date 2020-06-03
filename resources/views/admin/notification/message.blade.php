<a class="clear">New Conversation(s).</a>
		@if(count($datas) > 0)
		<a id="conv-notf-clear" data-href="{{ route('conv-notf-clear') }}" class="clear" href="javascript:;">
			Clear All
		</a>
		<ul>
		@foreach($datas as $data)
			<li>
				<a href="{{ route('admin-message-show',$data->conversation_id) }}"> <i class="fas fa-envelope"></i> You Have a New Message.</a>
			</li>
		@endforeach

		</ul>

		@else 

		<a class="clear" href="javascript:;">
			No New Notifications.
		</a>

		@endif