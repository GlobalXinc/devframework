<?php
// include settings file
require_once './settings.php';

// include this file for auto load class from control
spl_autoload_register(function($class)
{
	$sources = array(
		"./request/system/" . $class . ".php",
		"./control/" . $class . ".look.php"
	);

	foreach ($sources as $source) {
		if(file_exists($source)) require_once $source;
	}
});

// cek request from user url. if any or not empty run this
if (isset($_GET['p']) && !empty($_GET['p']))
{
	$p = strtolower($_GET['p']);
	$p = rtrim($p, "/");
	$p = str_replace("-", "_", $p);
	$p = explode("/", $p);

	// if segmen 0 empty load default class
	$class = !empty($p[0]) ? $p[0] : "Home";

	// check if class exist
	$class = class_exists($class) ? $class : "Home";

	// delete request from segmen 0
	unset($p[0]);

	// if segmen 1 empty load default method
	$method = !empty($p[1]) ? $p[1] : "index";

	// check if method exist
	$method = method_exists($class, $method) ? $method : "error";

	// delete request from segmen 1
	unset($p[1]);

	// if any request from segmen p load this
	$params = array_values($p);

	// delete parameter from request
	unset($p);

	// initialize new class
	// $class =  new $class;

	// load class, method and parameter
	call_user_func_array(array($class, $method), $params);
}

// if no request
else
{
	Home::index();
}