<?php

//namespace Pichkrement\Messenger;

//use Illuminate\Support\ServiceProvider;
//use Illuminate\View\Environment;


$prefix = Config::get('messenger::messenger.route_prefix');

//TODO: asset $prefix not empty string

function getConversations(){
	$cons = Conversation::all();
	$conversations = array();

	//add users to conversations
	foreach($cons as &$con){
		//find Users of specific conversation
		$item = array();

		$item['id'] = $con->id;
		$item['name'] = $con->name;
		$item['users'] = $con->users()->get()->toArray();

		array_push($conversations, $item);
	}

	return $conversations;
}

Route::get("messages", "ConversationsController@test");
/*
Route::get($prefix, array('before' => 'admin', function(){

	$cons = getConversations();

	return View::make("messenger::conversations")->with('conversations', $cons);

}));

//Display messages from specific conversation
Route::get($prefix.'/{id}', array('before' => 'admin', function(){

	$con = Conversation::find($id);

	if($con == null)
		return "unknown ID";

	$msgs = $con->messages()->get();

	return View::make("messenger::messages")->with('messages', $msgs);

}));

Route::get('test', array('before' => 'admin', function()
{
    
}));
*/