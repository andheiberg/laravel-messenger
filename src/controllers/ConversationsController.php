<?php
namespace Pichkrement\Messenger\Controllers;

use Pichkrement\Messenger\Models;

class ConversationsController extends \BaseController{

    public function info(){

    	return View::make('info', array('msgnum' => Messsage::count()));
    }

}
?>