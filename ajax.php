<?php
require_once 'config/config.php';
require_once 'classes/BaseFunctions.php';

$baseFunctions = new BaseFunctions();
if (isset($baseFunctions->rep['ajxrsp'])) {
    echo json_encode($baseFunctions->rep['ajxrsp']);
}else{
    echo json_encode(array('success'=>false, 'msg'=>"no response"));
}