<?php
    require_once '../vendor/autoload.php';

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    

    \App\staff::getInstance(json_decode(file_get_contents("php://input"), true))->deleteStaff("13");
?>
<!-- \\\ -->