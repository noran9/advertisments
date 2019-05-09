<?php

function call($controller, $action){

	require_once("controller/$controller.php");
	require_once("model/$controller.php");

	$controller = new $controller;
	$controller->{$action}();
}

$controllers = array(
    'comment' => ['all', 'forProduct', 'insert', 'forUser', 'delete']
);

if(isset($controller)){
	if (array_key_exists($controller, $controllers)) {
	    if (in_array($action, $controllers[$controller])) 
	        call($controller, $action);
	}
}
?>