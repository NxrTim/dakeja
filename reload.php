<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Berlin');

$liveversteigerung = "false";
?>
<p id="time">Letzte Aktualisierung: <?php echo date('H:i:s'); ?></p>
<?php
if($liveversteigerung == "false"){
    ?>
<p id="topic-3">Aktuell läuft keine Artiekl Versteigerung.</p>

<?php
}