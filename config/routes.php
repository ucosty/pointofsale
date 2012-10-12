<?php
	$map->root(array('controller' => 'sales', 'action' => 'index'));

    // The default route
    $map->connect('/:controller/[:action]/[:id]');
?>