<?php
require_once 'config/config.php';
require_once 'classes/BaseFunctions.php';
require_once 'classes/AdminFunctions.php';

$adminFunctions = new AdminFunctions();

// var_dump($adminFunctions);

if ( !$adminFunctions->admin_status ) {
	header("location: /");
	exit();
}

if ( !empty($adminFunctions->view) ) {
	$view = $adminFunctions->view;
}

if ( !empty($adminFunctions->redirect) ) {
	header("location: ".$adminFunctions->redirect);
	exit();
}

$view_file = 'views/'.$view.'.php';

if (file_exists($view_file)) {
	// echo 'exists';
	include_once "$view_file";
}else {
	// echo '!exists';
	include_once 'views/a_index.php';
}