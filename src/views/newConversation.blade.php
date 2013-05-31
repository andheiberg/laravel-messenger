{{ Form::open()}}

<h3>New Conversation</h3>
{{Form::label('convName', 'Conversation Name')}}
{{Form::text('convName')}}
{{Form::label('participants', 'Participants')}}
{{Form::textarea('participants')}}
{{Form::label('message', 'Message')}}
{{Form::textarea('message')}}
{{Form::submit('Send')}}

{{Form::close()}}