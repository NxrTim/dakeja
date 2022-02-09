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
$url = "dakeja.fleischer-home.de";


$sql = "SELECT * FROM `settings` WHERE setting='live'";
$settings_live = $pdo1->query($sql)->fetch();

$sql = "SELECT * FROM `settings` WHERE setting='start'";
$settings_start = $pdo1->query($sql)->fetch();

$sql = "SELECT * FROM `settings` WHERE setting='product_id'";
$settings_product_id = $pdo1->query($sql)->fetch();
?>
    <p id="time">Letzte Aktualisierung: <?php echo date('H:i:s'); ?></p>
<?php
if($settings_live['value'] != "false"){
    if($settings_start['value'] > time()){
        $timo = $settings_start['value'] - time();
        $realtime = date('M j, Y H:i:s', $settings_start['value']);
        ?>
        <script>
            var countDownDate = new Date("<?php echo $realtime; ?>").getTime();
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                if(seconds < 10) {
                    var secondss = "0" + seconds;
                }else{
                    var secondss = seconds;
                }
                if(minutes < 10) {
                    var minutess = "0" + minutes;
                }else{
                    var minutess = minutes;
                }
                document.getElementById("countdown").innerHTML = minutess + ":" + secondss;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "Zeit abgelaufen!";
                }
            }, 1000);
        </script>
        <span id="vor_countdown">Verbleibende Zeit: </span><b><span id="countdown"><?php echo date('i:s', $timo) ?></span></b>
        <?php
    }else{
        $sql = "UPDATE `settings` SET `value` = 'false' WHERE `settings`.`id` = 1;";
        $settings_start = $pdo1->query($sql)->fetch();
        ?>

        <?php
    }
}