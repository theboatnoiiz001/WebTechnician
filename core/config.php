<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set("Asia/Bangkok");
session_start();
$CONF = array();
$CONF["host"] = "localhost:3306";
$CONF["user"] = "root";
$CONF["pass"] = "";
$CONF["name"] = "technician";

$connect = new PDO("mysql:host=" . $CONF["host"] . ";dbname=" . $CONF["name"] . ";" , $CONF["user"] , $CONF["pass"] , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")) or die ("ERROE SQL");
$connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
$website = "http://localhost/WebTechnician";
$partUpload = "http://localhost/WebTechnician/uploads/";
if(isset($_SESSION['uid'])){
    $member = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $member->execute([$_SESSION['uid']]);
    $member = $member->fetch();
}

include("function.php");
?>