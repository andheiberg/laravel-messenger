{{ Form::open()}}

<h3>New Conversation</h3>
{{Form::label('participants', 'Add Participants')}}
{{Form::textarea('participants')}}
{{Form::label('message', 'Message')}}
{{Form::textarea('message')}}
{{Form::submit('Send')}}

{{Form::close()}}