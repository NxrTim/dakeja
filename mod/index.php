<title>Dakeja &bull; Versteigerung | MODERATION</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">
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
    </body>

