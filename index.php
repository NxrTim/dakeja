<title>Dakeja &bull; Versteigerung</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">
<?php
session_start();
$url = "dakeja.fleischer-home.de";
if(isset($_POST['dakeja_number'])){
    $_SESSION['dakeja_number'] = htmlspecialchars($_POST['dakeja_number']);
    header('location: https://'.$url.'/');
    exit();
}
if(!isset($_SESSION['dakeja_number'])){
?>
        <form method="post">
            <p id="topic-1">Deine Dakeja-Nummer oder Tikok-Name:</p>
            <input type="text" name="dakeja_number" id="dakeja_number" placeholder="15" autofocus>
            <input type="submit" id="button-1" value="loslegen">
        </form>
<?php
}else{
    ?>
    <p id="topic-2">Deine Dakeja-Nummer/ TikTokName: <b><?= $_SESSION['dakeja_number'] ?></b></p><br>
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

    <div id="target"></div>
    </body>
<?php
}
