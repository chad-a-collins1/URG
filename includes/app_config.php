<?php


@session_start();
@ob_start();

error_reporting(0);



ini_set("display_errors","on");
define("ROOT","/var/www/html/ecomply-urg-certification.com/public_html/");
define('INC_ADMIN',ROOT."admin/inc/");
define("SITE_NAME","URG Cetification Relaunch");
define("TITLE","Welcome to URG Cetification Relaunch");
define("TITLE_ADMIN","Control Panel :: URG");
define("SITE_URL","https://www.ecomply-urg-certification.com/");
define("senderemail","sysadmin@ecomply-urg-certification.com");
define('AWS_KEY', '5RdgtgXKtNV3-NoWnpD8');
define('AWS_SECRET_KEY', 'o8_QTRvw1eNhk0FnW-_ICwuympqXIkZbEVjrVUb3');
define('HOST', 'https://objects-us-west-1.dream.io');




$glob['bucket'] = 'client_documents';



?>