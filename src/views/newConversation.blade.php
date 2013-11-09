<h3>New Conversation</h3>

{{ Form::open(array('class'=>'form-horizontal'))}}


  <div class="form-group">
	{{Form::label('convName', 'Conversation Name', array('class' => 'col-sm-2'))}}

    <div class="col-sm-10">
    	{{Form::text('convName', null,  array('class' => 'form-control'))}}
    </div>
  </div>

  <div class="form-group">
	{{Form::label('participants', 'Participants', array('class' => 'col-sm-2'))}}

    <div class="col-sm-10">
    	{{Form::text('participants', null, array('class' => 'form-control'))}}
    </div>
  </div>

  <div class="form-group">
  	{{Form::label('message', 'Message', array('class' => 'col-sm-2'))}}

    <div class="col-sm-10">
    	{{Form::textarea('message', null, array('class' => 'form-control'))}}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    	{{Form::submit('Send', array('class' => 'btn btn-default'))}}
    </div>
  </div>

{{Form::close()}}
