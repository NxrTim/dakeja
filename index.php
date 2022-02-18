<title>Dakeja &bull; Versteigerung</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=0.5, user-scalable=no">
<?php
session_start();
$url = "dakeja.fleischer-home.de";
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
    $mobile = "true";
}else{
    $mobile = "false";
}
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
                <p id="topic-1">Deine Dakeja-Nummer<?php if($mobile == "true"){ echo '<br>'; } ?> oder Tikok-Name:</p>
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
