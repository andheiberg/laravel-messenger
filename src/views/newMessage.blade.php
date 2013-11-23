{{ Form::open(array('class'=>'form-horizontal', 'action'=>'MessageController@store'))}}


  <div class="form-group">
      {{Form::textarea('content', null, array('class' => 'form-control'))}}
      {{Form::hidden('conversation_id', $active_id)}}

      {{Form::submit('Send', array('class' => 'btn btn-default'))}}
  </div>

{{Form::close()}}