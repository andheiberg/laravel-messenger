<?php

$prefix = Config::get('messenger::messenger.route_prefix');

//TODO: asset $prefix not empty string

Route::get($prefix, function(){
	echo "Nicht";
});

Route::get($prefix."/inbox", function(){
	
});