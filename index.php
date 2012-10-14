<?php
	
	// Point Of Sale
	// Written by Matthew Costa
	session_start();

    require_once("framework/router.php");
    require_once("framework/templates.php");
    require_once("framework/ActiveRecord.php");
    require_once("framework/fileuploads.php");
    require_once("framework/hash.php");

    $map = new PathRouter();

	require_once('config/application.php');
  	require_once('config/routes.php');

	date_default_timezone_set($_CONFIG['timezone']);

	// Parse the URL variable or use the default '/' path
	$url = isset($_GET['url'])? $_GET['url'] : '/';
	$map->parse($url);
  	
	// Load all of the models
  	foreach (glob("app/models/*.php") as $filename)
    {
        require_once $filename;
    }
    
  	// Load all of the helpers
  	foreach (glob("app/helpers/*.php") as $filename)
    {
        require_once $filename;
    }

    require_once("app/controllers/" . Params::controller() . ".php");

    // Instance and run the controller
    $controller_class = ucfirst(Params::controller()) . "Controller";
    
    if(!class_exists($controller_class)) {
        // Class does *not* exist, die
        die("{$controller_class} does not exist.");
    }
    
    $controller = new $controller_class();
    $action = Params::action();
    
    if(!method_exists($controller, $action)) {
        if(method_exists($controller, "_{$action}")) {
            $action = "_{$action}";
        } else {
            //if(!$_CONFIG['controller']['autoaction']) {
                die("No such action '{$action}' in {$controller_class}");        
            //}
        }
    }
    
    if(method_exists($controller, '__before_filter')) {
        $controller->__before_filter();
    }
    
    $controller->$action();

    if(method_exists($controller, '__after_filter')) {
        $controller->__after_filter();
    }
    
    Templates::RenderTemplateFallback();
    
    session_destroy();
?>