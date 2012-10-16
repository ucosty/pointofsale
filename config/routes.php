<?php
	$map->root(array('controller' => 'sales', 'action' => 'index'));

	$map->connect('/admin/vouchers/[:action]/[:id]', array('controller' => 'vouchers'));

	$map->connect('/login', array('controller' => 'users', 'action' => 'login'));
	$map->connect('/logout', array('controller' => 'users', 'action' => 'logout'));

    // The default route
    $map->connect('/:controller/[:action]/[:id]');
?>