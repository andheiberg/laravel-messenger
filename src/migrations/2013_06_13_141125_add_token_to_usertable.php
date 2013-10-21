<?php

use Illuminate\Database\Migrations\Migration;

class AddTokenToUsertable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
	    {
	        $table->string('token')->unique()->nullable();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->drop_column('token');
	}

}