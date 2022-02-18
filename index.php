<title>Dakeja &bull; Versteigerung</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php
session_start();
$url = "dakeja.fleischer-home.de";
?>

<link rel="stylesheet" href="https://<?= $url; ?>/style.css?<?= time(); ?>" type="text/css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div id="wrapper">
    <div id="main">
    <?php
    if(isset($_POST['dakeja_number'])){
        $_SESSION['dakeja_number'] = htmlspecialchars($_POST['dakeja_number']);
        $_SESSION['terms'] = "true";
        header('location: https://'.$url.'/');
        exit();
    }

    if(!isset($_SESSION['dakeja_number'])){
    ?>
            <form method="post">
                <p id="topic-1">Deine Dakeja-Nummer oder Tikok-Name:</p>
                <input type="text" name="dakeja_number" id="dakeja_number" placeholder="15" autofocus required>
                <input type="submit" id="button-1" value="loslegen">
            </form>
    <?php
    }else{
        if(isset($_SESSION['terms'])){
            unset($_SESSION['terms']);
            ?>
        <script>
            swal({
                title: "Achtung",
                text: "Teilnahme ist erst ab 18 Jahren gestattet und ist ein Kaufvertrag.",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Ablehnen",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Zustimmen",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                },
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
                .then((willDelete) => {
                    if (!willDelete) {
                        swal("Leider ist für dich die Teilnahme nicht möglich.");
                        var cookieList = (document.cookie) ? document.cookie.split(';') : [];

                        var cookieValues = {};
                        for (var i = 0, n = cookieList.length; i != n; ++i) {
                            var cookie = cookieList[i];
                            var f = cookie.indexOf('=');
                            if (f >= 0) {
                                var cookieName = cookie.substring(0, f);
                                var cookieValue = cookie.substring(f + 1);

                                console.log ("cookieName + " + cookieName + " cookieValue " + cookieValue);

                                if (!cookieValues.hasOwnProperty(cookieName)) {
                                    cookieValues[cookieName] = cookieValue;
                                }
                            }
                        }
                        document.location="https://<?= $url ?>.de";
                    }
                });
        </script>
        <?php
        }
        ?>
        <p id="topic-2">Deine Dakeja-Nummer/ TikTokName: <b><?= $_SESSION['dakeja_number'] ?></b></p><br>
        <head>
            <meta name="viewport" content="width=device-width">
            <script type="text/javascript">
                var updateDiv = function ()
                {
                    $('#target').load('reload.php?num=<?= $_SESSION['dakeja_number'] ?>');
                }

                var deinTimer = window.setInterval(updateDiv, 5000);
            </script>
        </head>
        <body>


        <div id="target">
            <p id="please_wait">Bitte warten der Inhalt wird geladen...</p>
        </div>
        </body>
    </div>
</div>
<?php
}
