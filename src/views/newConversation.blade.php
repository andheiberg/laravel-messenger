
{{ Form::open(array('class'=>'form-horizontal'))}}


  <div class="input-group">

      {{Form::text('name', null,  array('class' => 'form-control', 'placeholder' => 'Conversation name'))}}
      {{Form::text('participants', null, array('class' => 'form-control', 'autocomplete' => 'off', 'id' => 'participants', 'placeholder' => 'participants'))}}

      {{Form::submit('+', array('class' => 'btn btn-default'))}}

  </div>

{{Form::close()}}
