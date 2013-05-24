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

	$con = Conversation::find(1);

	echo "test";

	$ommi = User::find(1);

	//var_dump($ommi->messages()->first());

	var_dump($con->users()->first());

	//foreach($cons as $con)
	//	$con->name;
	//test login

	return View::make('messenger::master');

});

//Display messages from specific conversation
Route::get($prefix.'/inbox/{id}', function($id){


	echo "Load inbox from Conversation with id: ".$id;


	//TODO nur Conversationen von eingeloggtem User anzeigen

	$messages = DB::table('messages')->where('conversation', '=', $id)->get();

	//var_dump($messages);	

	return View::make('messenger::conversation.inbox', array('id' => $id));

});
