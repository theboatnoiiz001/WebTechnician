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

function getProvince($id,$connect){
    $province = $connect->prepare("SELECT `name_en` FROM `provinces` WHERE `code` = ?");
    $province->execute([$id]);
    $province = $province->fetch();

    return $province['name_en'];
}

function getTypeFix($id){
    if($id == 1){
        return "Air condition";
    }else if($id == 2){
        return "Refrigerator";
    }else if($id == 3){
        return "Drain pipe";
    }else if($id == 4){
        return "Shower";
    }else if($id == 5){
        return "Unknow";
    }else{
        return "Unknow";
    }
}

function getRanking($id,$connect){
    
    $getTech = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $getTech->execute([$id]);
    $getTech = $getTech->fetch();

    $ranking = floor($getTech['ranking']);
    $star = "";

    for($i=0;$i<5;$i++){
        if($ranking > 0){
            $star = $star.'<i class="fas fa-star checked"></i>';
        }else{
            $star = $star.'<i class="fas fa-star"></i>';
        }
        $ranking--;
    }
    return $star;

}

function getStar($number){
    
    $ranking = floor($number);
    $star = "";

    for($i=0;$i<5;$i++){
        if($ranking > 0){
            $star = $star.'<i class="fas fa-star checked"></i>';
        }else{
            $star = $star.'<i class="fas fa-star"></i>';
        }
        $ranking--;
    }
    return $star . ' ('.$number.'/5)';

}

function getPrice($id){
    if($id == 1){
        return "1,000-1,999";
    }else if($id == 2){
        return "2,000-4,999";
    }else if($id == 3){
        return "5,000+";
    }
}

function getStatusType($id){
    if($id == 0){
        return "Find a Technician";
    }else if($id == 1){
        return "On Fixing";
    }else if($id == 2){
        return "Trouble Fixed";
    }
}

function getStatusTech($id){
    if($id == 1){
        return "Work Finding";
    }else if($id == 2){
        return "On Working";
    }else if($id == 3){
        return "Unavailable";
    }
}

?>