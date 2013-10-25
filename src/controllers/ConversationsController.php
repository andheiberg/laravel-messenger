<?php
namespace Pichkrement\Messenger\Controllers;

class ConversationsController extends \BaseController{

    public function info(){

    	$nummsg = \Pichkrement\Messenger\Models\Message::count();
    	$numusr = \Pichkrement\Messenger\Models\User::count();
    	$numcon = \Pichkrement\Messenger\Models\Conversation::count();

    	$return = "<html><body>
    		Messages: $nummsg <br/>
    		Users: $numusr <br/>
    		Konversations: $numcon <br/>
    	</body></html>";

    	return $return; //\View::make('info', array('msgnum' => \Pichkrement\Messenger\Models\Message::count()));
    }

}
?>