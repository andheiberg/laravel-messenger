@extends('messenger::master')

@section('sidebar')
    @parent
    <p>Extends Navigation in Messages</p>
@stop

@section('header')
    <h1>All Messages from specific conversation</h1>
@stop

@section('content')
	
	<table>
		<tr>
			<th>
				ID
			</th>

			<th>
				content
			</th>

			<th>
				from
			</th>

		</tr>

		@foreach($messages as $msg)
			<tr>
				<td>
					{{$msg['id']}}
				</td>

				<td>
					{{$msg['content']}}
				</td>

				<td>
					{{$msg->user->username}}
				</td>
			</tr>
		@endforeach

	</table>	

	@include('messenger::newMessage')
    <p>List of all Messages</p>
@stop