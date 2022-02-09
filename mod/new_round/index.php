<?php
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Berlin');
$db_host = 'localhost';
$db_name = 'DaKeJa';
$db_user = 'dakeja_versteigerung';
$db_password = '$62Ztx9o';
$pdo1 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$con1 = new mysqli($db_host, $db_user, $db_password, $db_name);
$url = "dakeja.fleischer-home.de";

$timetoend = time()+60;

$sql = "UPDATE `settings` SET `value` = '" . $timetoend . "' WHERE `settings`.`id` = 5;";
$editSettings = $pdo1->query($sql)->fetch();

getproid:
$product_id = rand(100000, 999999);
$sql = "SELECT * FROM `winners` WHERE product_id = '" . $product_id . "'";
$genPro = $pdo1->query($sql)->rowCount();
if($genPro != 0){
    goto getproid;
}

$sql = "UPDATE `settings` SET `value` = '" . $product_id . "' WHERE `settings`.`id` = 3;";
$editSettings = $pdo1->query($sql)->fetch();

$sql = "UPDATE `settings` SET `value` = 'true' WHERE `settings`.`id` = 1;";
$editSettings = $pdo1->query($sql)->fetch();

header('location: https://'.$url.'/mod/');
exit();