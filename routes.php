<?php

//namespace Pichkrement\Messenger;

//use Illuminate\Support\ServiceProvider;
//use Illuminate\View\Environment;


$prefix = Config::get('messenger::messenger.route_prefix');

//TODO: asset $prefix not empty string

Route::get($prefix, function(){
	echo "Nicht";

	var_dump(User::first());

	//return View::make("");
});

Route::get($prefix."/inbox", function(){

	$cons = Conversation::all();

	foreach($cons as $con){
		echo "--> ". $con->name;
	}

	return View::make("messenger::conversation.index");

});

//Display messages from specific conversation
Route::get($prefix.'/inbox/{id}', function($id){
	$con = Conversation::find($id);

	if($con == null)
		return "failure"; //TODO

	$msgs = $con->messages()->get();

	foreach($msgs as $msg){
		echo "---> ". $msg->user->username;
	}

	//return View::make('messenger::conversation.inbox', array('id' => $id));

});
