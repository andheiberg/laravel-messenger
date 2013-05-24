{{ Form::open('message/messages')}}

{{-- Hidden fields for automatic Email-Notification --}}
{{-- from: eingeloggter user. Schickt Nachricht an 'to'. --}}
{{-- to: user, dessen Nachrichten geladen wurde, und der die Antwort erhaelt --}}
{{Form::hidden('to', $fromuser->id)}}
{{Form::hidden('username', $fromuser->username)}}

<h3>Antworten</h1>
{{Form::label('message', 'Nachricht')}}
<textarea rows="3" name = "message" id = "message"></textarea>

{{Form::submit('Send')}}


{{Form::close()}}
