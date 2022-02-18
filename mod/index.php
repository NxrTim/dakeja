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
        <input type="number" value="" placeholder="60"><br>
        <span>Anzal Gewinner: </span>
        <input type="number" value="1" placeholder="1"><br><br>
        <input type="submit" value="Neue Versteigerung starten">
    </form>
    </body>

