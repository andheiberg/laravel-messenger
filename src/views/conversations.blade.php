@extends('messenger::master')

@section('navigation')
    @parent
    <p>Extends Navigation in Conversations</p>
@stop

@section('header')
    <h1>Your Conversations</h1>
@stop

@section('content')

	<table>
		<tr>
			<th>
				ID
			</th>

			<th>
				Name
			</th>

			<th>
				Members
			</th>
		</tr>


		@foreach($conversations as $con)
			<tr>
				<td>
					{{$con['id']}}
				</td>

				<td>
					{{$con['name']}}
				</td>

				<td>
					@foreach($con['users'] as &$user)
						{{$user['username']}}
					@endforeach
				</td>
			</tr>
		@endforeach

	</table>


	@include('messenger::newConversation')
    <p>List of all Conversations</p>
@stop

