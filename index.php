<title>Dakeja &bull; Versteigerung</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=0.6, user-scalable=no">
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
                        document.cookie = "PHPSESSID=;Path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
                        document.location="https://<?= $url ?>";
                    }
                });
        </script>
        <?php
        }
        ?>
        <p id="topic-2">Deine Dakeja-Nummer/ TikTokName: <b><?= $_SESSION['dakeja_number'] ?></b></p><br>
        <head>
            <script type="text/javascript">
                var updateDiv = function ()
                {
                    $('#target').load('reload.php?num=<?= $_SESSION['dakeja_number'] ?>');
                }

                var deinTimer = window.setInterval(updateDiv, 5000);

            </script>
        </head>
        <body>
<

        <div id="target">
        </div>
        </body>
    </div>
</div>
<?php
}
