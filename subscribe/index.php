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

$sql = "SELECT * FROM `settings` WHERE setting='product_id'";
$settings_product_id = $pdo1->query($sql)->fetch();

$sql = "SELECT * FROM `subscribers` WHERE number_or_name = '" . $_SESSION['dakeja_number'] . "'";
$sub_rows = $pdo1->query($sql)->rowCount();
if($sub_rows == 0){
    $statement = $pdo1->prepare("INSERT INTO `subscribers`(`number_or_name`, `product_id`, `time`, `ip`) VALUES (?,?,?,?)");
    $statement->execute(array($_SESSION['dakeja_number'], $settings_product_id['value'], time(), $_SERVER['REMOTE_ADDR']));
}?>
<meta http-equiv="refresh" content="1"; URL="https://<?= $url; ?>/">