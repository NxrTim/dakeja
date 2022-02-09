<title>Dakeja &bull; Versteigerung</title>
<?php
$url = "dakeja.fleischer-home.de";
if(isset($_POST['dakeja_number'])){
    $_SESSION['dakeja_number'] = htmlspecialchars($_POST['dakeja_number']);
    header('location: https://'.$url.'/');
    exit();
}
if(!isset($_SESSION['dakeja_number'])){
?>
        <form method="post">
            <p>Deine Dakeja-Nummer oder Tikok-Name:</p>
            <input type="text" name="dakeja_number" id="dakeja_number" placeholder="15">
            <input type="submit" value="loslegen">
        </form>
<?php
}else{
    ?>
<p>Deine Dakeja-Nummer/ TikTokName: <b><?= $_SESSION['dakeja_number'] ?></b></p>
<?php
}