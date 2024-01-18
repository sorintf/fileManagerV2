<?php
require_once 'config/config.php';
require_once 'classes/BaseFunctions.php';
require_once 'classes/AdminFunctions.php';
require_once 'classes/DataTableSPP.php';

$primaryKey = "ID";
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db'   => DB_NAME,
    'host' => DB_HOST
);

$user = new AdminFunctions();

$json = array('message'=>"here is the start");

if (isset($_GET['w'])) {
    $w = trim(htmlspecialchars($_GET['w']));
}else{
    $w = "";
}

switch ($w) {

    case 'users_list':
        $table = "users";
        $columns = array(

            array('db'=>'username',            'dt'=>0), 
            array('db'=>'firstname_user',      'dt'=>1), 
            array('db'=>'lastname_user',       'dt'=>2), 
            array('db'=>'email_user',          'dt'=>3), 
            array('db'=>'tel_user',            'dt'=>4), 
            array('db'=>'created_time',        'dt'=>5), 
            array('db'=>'ID',                  'dt'=>6)
        );
        $json = SSP::usersByStatus( $_GET, $sql_details, $table, $primaryKey, $columns );
        // $json = SSP::Test( $_GET, $sql_details, $table, $primaryKey, $columns );
        break;

    
    default:
        $json = array('message'=>"nothing was given as W in the list that is ok");
        break;
}
echo json_encode($json);