<?php include 'header.php'; 

require_once("db.php");

if(isset($_GET["controller"])&&isset($_GET["action"])){
    $controller=$_GET["controller"];
    $action=$_GET["action"];
    require_once("routes.php");
}
else
	include 'products.php';

include 'footer.php'; 
