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
	//test login

	//show all conversations
	echo "Conversations";

});

Route::get($prefix."/conversation/{id}", function(){
	//test login

	//show all conversations
	echo "Conversations";

});