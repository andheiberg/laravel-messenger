<?php
namespace Pichkrement\Messenger\Controllers;

class ConversationsController extends \BaseController{

    public function info(){

    	return \View::make('info', array('msgnum' => \Pichkrement\Messenger\Models\Message::count()));
    }

}
?>