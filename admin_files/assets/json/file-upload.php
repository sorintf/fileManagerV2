<?php
$ds= DIRECTORY_SEPARATOR;  //1
$storeFolder = 'uploads';   //2
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];          //3             
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
    Array($tempFile,$targetFile); //6
}
?> 