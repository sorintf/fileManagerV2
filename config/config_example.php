<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);

session_start();
error_reporting(E_ALL);
// error_reporting(E_ERROR);
// ini_set('max_execution_time', 21600); // 6 hours
ini_set('max_execution_time', 600); // 10 minutes

date_default_timezone_set('Europe/Bucharest');
setlocale(LC_ALL, 'ro_RO.utf8');
#strftime("%e %b %Y", strtotime("2019-12-05")); // how to use in php to local format

define("DB_HOST", "localhost"); // usualy works with localhost
define("DB_NAME", "THE_NAME_OF_THE_DATABASE"); // easily created in phpmyadmin
define("DB_USER", "THE_NAME_OF_THE_USER"); // easily created in phpmyadmin, don't forget to add the user to the database with desired permissions
define("DB_PASS", "PASSWORD"); // as complex as possible
define("DB_SECRET", "STRING"); // use this with AES_ENCRYPT/AES_DECRYPT on varbin collumns

define("COOKIE_RUNTIME", 1209600);
define("COOKIE_DOMAIN", ".yourdomain.com"); // set up your domain
define("COOKIE_SECRET_KEY", "ANOTHERSTRING");

// if you use MailJet API 
define("MJ_APIKEY_PUBLIC", "MJ_APIKEY_PUBLIC"); // public key MJ
define("MJ_APIKEY_PRIVATE", "MJ_APIKEY_PRIVATE"); // private key MJ
define("MJ_MANAGE_CONTACT", 10000); // contact list id (int)
define("MJ_URL", "URLTOSOMEFILE"); // file that groups all the emails calls to MJ API


define("BASE_URL", "https://www.base.twoandfrom.com"); // probabily better to do it some other way

define("FORMAT_DATE", "Y-m-d");
define("FORMAT_DATE_RO_L", "d-m-Y H:i:s");
define("FORMAT_DATE_RO_S", "d-m-Y");

define("MESSAGE_DATABASE_ERROR", "Eroare conectare la baza de date"); // generic message for db connection

if (isset($_GET['action'])) {
	$action = $_GET['action'];
}else{
	$action = "";
}
if ($action=='logout') {
	$action = 'f_index';
}