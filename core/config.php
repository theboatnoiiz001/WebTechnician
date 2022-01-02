<?php
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
    $user = $connect->prepare("SELECT * FROM `user` WHERE `id` = ?");
    $user->execute([$_SESSION['uid']]);
    $user = $user->fetch();
}
?>