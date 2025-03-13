<?php
session_start();
require_once("./model/clientModel.php");
define('PAGE','http://faty.niass.ecole221.sn:8005/?');


if (isset($_REQUEST["controller"])) {
    $controller=$_REQUEST["controller"];
    if ($controller=="clientController") {
        require_once("./controller/clientController.php");
    } 
} else {
    require_once("./controller/clientController.php");
}