<title>Dakeja &bull; Versteigerung | MODERATION</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
    *{
    font-size: 30px;
    }
</style>
<?php
session_start();
$url = "dakeja.fleischer-home.de";
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Berlin');
$db_host = 'localhost';
$db_name = 'DaKeJa';
$db_user = 'dakeja_versteigerung';
$db_password = '$62Ztx9o';
$pdo1 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$con1 = new mysqli($db_host, $db_user, $db_password, $db_name);

$sql = "SELECT * FROM `settings` WHERE setting='time'";
$settings_time = $pdo1->query($sql)->fetch();
?>
    <head>
        <script type="text/javascript">
            var updateDiv = function ()
            {
                $('#target').load('reload.php');
            }

            var deinTimer = window.setInterval(updateDiv, 5000);
        </script>
    </head>
    <body>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#target").load("reload.php");
        });
    </script>


    <div id="target">
        <p id="please_wait">Bitte warten der Inhalt wird geladen...</p>
    </div>
    <form action="https://<?= $url; ?>/mod/new_round/" method="post"><br>
        <span>Versteigerungszeit: </span>
        <input id="time" type="number" value="<?= $settings_time['value'] ?>" placeholder="60"><br>
        <span>Anzal Gewinner: </span>
        <input id="winners" type="number" value="1" placeholder="1"><br><br>
        <input id="submiti" type="submit" value="Neue Versteigerung starten">
    </form>
    </body>

