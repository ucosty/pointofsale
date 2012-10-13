<?php
	$_CONFIG['timezone'] = 'Australia/Sydney';

	// Automatically generate blank actions if template exists
	$_CONFIG['controller']['autoaction'] = true;

	ActiveRecord\Config::initialize(function($cfg)
	{
	    $cfg->set_model_directory('app/models/');
	    $cfg->set_connections(array('development' => 'mysql://root@127.0.0.1/sales'));
	});
?>