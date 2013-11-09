<h3>New Conversation</h3>

{{ Form::open(array('class'=>'form-horizontal'))}}


  <div class="form-group">
    {{Form::label('participants', 'Add Participants')}}
    <div class="col-sm-10">
    	{{Form::textarea('participants', array('class' => 'form-control'))}}
    </div>
  </div>
  <div class="form-group">
  	{{Form::label('message', 'Message', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-10">
    	{{Form::textarea('message', array('class' => 'col-sm-2 control-label'))}}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    	{{Form::submit('Send', array('class' => 'btn btn-default'))}}
    </div>
  </div>

{{Form::close()}}