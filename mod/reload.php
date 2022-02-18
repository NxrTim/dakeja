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

        $sql = "SELECT * FROM `subscribers`";
        $allsubers = $pdo1->query($sql)->rowCount();
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
        <span id="vor_countdown">Verbleibende Zeit: </span><b><span id="countdown"><?php echo date('i:s', $timo); ?></span></b><br>
        <span id="vor_subs">Teilnehmer: </span><b><span id="subs"><?= $allsubers; ?></span></b>
        <?php
    }
}else{
    $sql = "UPDATE `settings` SET `value` = 'false' WHERE `settings`.`id` = 1;";
    $settings_start = $pdo1->query($sql)->fetch();

    $sql = "SELECT * FROM `subscribers`";
    $suber = $pdo1->query($sql)->rowCount();

    $sql = "SELECT * FROM `winners` WHERE product_id = '" . $settings_product_id['value'] . "'";
    $sel_winner = $pdo1->query($sql)->rowCount();
    if($sel_winner == 0){
        if($suber != 0) {
            $subs = array();
            $sql = "SELECT * FROM subscribers WHERE product_id = '" . $settings_product_id['value'] . "'";
            foreach ($pdo1->query($sql) as $row) {
                $subs[] = $row['id'];
            }
            $max = $suber - 1;
            $randomnumber = rand(0, $max);

            $sql = "SELECT * FROM `subscribers` WHERE id = '" . $subs[$randomnumber] . "'";
            $winner_info = $pdo1->query($sql)->fetch();

            $statement = $pdo1->prepare("INSERT INTO `winners`(`product`, `product_id`, `price`, `number_or_name`, `time`) VALUES (?,?,?,?,?)");
            $statement->execute(array(NULL, $settings_product_id['value'], NULL, $winner_info['number_or_name'], time()));

            $sql = "DELETE FROM `subscribers`";
            $winnesssr_info = $pdo1->query($sql)->fetch();
        }else{
            $statement = $pdo1->prepare("INSERT INTO `winners`(`product`, `product_id`, `price`, `number_or_name`, `time`) VALUES (?,?,?,?,?)");
            $statement->execute(array(NULL, $settings_product_id['value'], NULL, "Keine Teilnehmer", time()));
        }

    }
    $sql = "SELECT * FROM `winners` WHERE product_id = '" . $settings_product_id['value'] . "'";
    $last_winner = $pdo1->query($sql)->fetch();
    ?>
    <span id="vor_winner" style="font-size: 50px">Gewinner:</span><b><span id="winner" style="font-size: 50px"><?php echo $last_winner['number_or_name']; ?></span></b><br>
    <form action="https://<?= $url; ?>/mod/new_round/" method="post">
        <span>Versteigerungszeit: </span>
        <input type="number" value="" placeholder="60"><br>
        <span>Anzal Gewinner: </span>
        <input type="number" value="" placeholder="1"><br>
        <input type="submit" value="Neue Versteigerung starten">
    </form>
    <?php
}