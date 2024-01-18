<?php
require_once 'config/config.php';
require_once 'classes/BaseFunctions.php';
require_once 'classes/AdminFunctions.php';

$adminFunctions = new AdminFunctions();

if ( $adminFunctions->admin_status<69 ) {
	die();
}

// $ctrlFile = "uploads-".date("YmdHis").".txt";

// $my_file = $_FILES['my_file'];
// $txt = date("Y-m-d H:i:s")." files: ".serialize($_FILES)."\n";
// file_put_contents($ctrlFile, $txt, FILE_APPEND);

// $my_post = $_POST;
// $txt = date("Y-m-d H:i:s")." my_post: ".serialize($my_post)."\n";
// file_put_contents($ctrlFile, $txt, FILE_APPEND);

// $my_GET = $_GET;
// $txt = date("Y-m-d H:i:s")." my_GET: ".serialize($my_GET)."\n";
// file_put_contents($ctrlFile, $txt, FILE_APPEND);


// $tmpFilePath = $my_file['tmp_name']; // temporary upload path of the file
// $txt = date("Y-m-d H:i:s")." tmpFilePath: ".$tmpFilePath."\n";
// file_put_contents($ctrlFile, $txt, FILE_APPEND);

// $file_name = $_POST['name']; // desired name of the file
// $txt = date("Y-m-d H:i:s")." file_name: ".$file_name."\n";
// file_put_contents($ctrlFile, $txt, FILE_APPEND);

// $base_name = basename($file_name);
// $txt = date("Y-m-d H:i:s")." base_name: ".$base_name."\n";
// file_put_contents($ctrlFile, $txt, FILE_APPEND);

// $filePath = "uploads/".$base_name;
// $txt = date("Y-m-d H:i:s")." filePath: ".$filePath."\n";
// file_put_contents($ctrlFile, $txt, FILE_APPEND);

// // save the file at `img/FILE_NAME`
// if (move_uploaded_file($tmpFilePath, $filePath )) {
// 	$txt = date("Y-m-d H:i:s")." move_uploaded_file\n";
// }else{
// 	$txt = date("Y-m-d H:i:s")." !move_uploaded_file\n";
// }