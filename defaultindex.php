<?php
ini_set('display_errors',1); 
error_reporting(0);

require_once("includes/app_config.php");

require("helperclasses/Utility.php");
require("helperclasses/Loader.php");
require("helperclasses/BaseController.php");
require("helperclasses/NewDatabase.php");
require("helperclasses/Template.php");
require("models/dashboard.php");
require("models/login.php");


require("controllers/dashboard.php");
require("controllers/login.php");



if(!isset($_SESSION['userid']))
{
    

    
$login = new LoginController();
$login->invoke();
			
    
 
}
else
{

    
$loader = new Loader($_GET);
$controller = $loader->CreateController();
$controller->ExecuteAction();

}

?>