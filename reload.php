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

$dakeja_num = htmlspecialchars($_GET['num']);

$sql = "SELECT * FROM `settings` WHERE setting='live'";
$settings_live = $pdo1->query($sql)->fetch();

$sql = "SELECT * FROM `settings` WHERE setting='start'";
$settings_start = $pdo1->query($sql)->fetch();

$sql = "SELECT * FROM `settings` WHERE setting='product_id'";
$settings_product_id = $pdo1->query($sql)->fetch();

if(isset($_GET['subscribe'])){
    $sql = "SELECT * FROM `subscribers` WHERE number_or_name = '" . $dakeja_num . "'";
    $sub_rows = $pdo1->query($sql)->rowCount();
    if($sub_rows == 0){
        $statement = $pdo->prepare("INSERT INTO `subscribers`(`number_or_name`, `product_id`, `time`, `ip`) VALUES (?,?,?,?)");
        $statement->execute(array($dakeja_num, $settings_product_id, time(), $_SERVER['REMOTE_ADDR']));
    }
}

$sql = "SELECT * FROM `subscribers` WHERE number_or_name = '" . $dakeja_num . "'";
$sub_is = $pdo1->query($sql)->rowCount();
if($sub_is == 0){
    $sub = "false";
}else{
    $sub = "true";
}

?>
<p id="time">Letzte Aktualisierung: <?php echo date('H:i:s'); ?></p>
<?php
if($settings_live['value'] == "false"){
    ?>
<p id="topic-3">Aktuell läuft keine Artiekl Versteigerung.</p>

<?php
}else{
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

            // Display the result in the element with id="demo"
            document.getElementById("countdown").innerHTML = minutess + ":" + secondss;

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "Zeit abgelaufen!";
            }
        }, 1000);
    </script>
        <b><p id="countdown"><?php echo date('i:s', $timo) ?></p></b>
        <?php
    }else{
        $sql = "UPDATE `settings` SET `value` = 'false' WHERE `settings`.`id` = 1;";
        $settings_start = $pdo1->query($sql)->fetch();
        ?>
        <b><p id="countdown">Zeit abgelaufen!</p></b>

            <?php
    }
        ?>
    <p id="topic-5">Verteigerung aktiv!</p>
    <?php
    if($sub == "true"){
        ?>
        <p>Du nimmst an der Versteigerung teil!</p>
        <?php
    }else{
    ?>
    <a href="?subscribe">Artikel ersteigern</a>
<?php
    }
}