<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Berlin');
$db_host = 'localhost';
$db_name = 'DaKeJa';
$db_user = 'dakeja_versteigerung';
$db_password = '$62Ztx9o';
$pdo1 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$con1 = new mysqli($db_host, $db_user, $db_password, $db_name);


$sql = "SELECT * FROM `settings` WHERE setting='live'";
$settings_live = $pdo1->query($sql)->rowCount();


?>
<p id="time">Letzte Aktualisierung: <?php echo date('H:i:s'); ?></p>
<?php
if($settings_live['value'] == "false"){
    ?>
<p id="topic-3">Aktuell läuft keine Artiekl Versteigerung.</p>

<?php
}else{
    ?>

    <p id="topic-5">Verteigerung aktiv!</p>
<?php
}