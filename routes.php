<?php

$prefix = Config::get('messenger::messenger.route_prefix');

//TODO: asset $prefix not empty string

Route::get($prefix, function(){
	echo "Nicht";
});

Route::get($prefix.'/inbox', function(){

	echo "Load Conversations. ";

	$conversations = DB::table('conversations')->get();

	var_dump($conversations);

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
