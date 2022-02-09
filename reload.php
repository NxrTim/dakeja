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
$settings_live = $pdo1->query($sql)->fetch();

$sql = "SELECT * FROM `settings` WHERE setting='start'";
$settings_start = $pdo1->query($sql)->fetch();

?>
<p id="time">Letzte Aktualisierung: <?php echo date('H:i:s'); ?></p>
<?php
if($settings_live['value'] == "false"){
    ?>
<p id="topic-3">Aktuell läuft keine Artiekl Versteigerung.</p>

<?php
}else{
    ?>
    <script>
        var countDownDate = "<?php echo $settings_start; ?>";
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("countdown").innerHTML = minutes + ":" + seconds;

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
    <b><p id="countdown">00:59</p></b>
    <p id="topic-5">Verteigerung aktiv!</p>
    <p>Nehme jetzt teil und ersteige den Artikel!</p>
<?php
}