<?php
    include("./config.php");
    include("./autoload.php");
    include("./ham.php");

    if (isset($_POST['btnComment'])) {
        $comment = $_POST['comment'];
        $maKH = $_SESSION['maKH'];
        $maDT = $_POST['maDT'];

        //table comment: MaBL,NoiDung,MaKH,MaDT
        $sqli->query("INSERT into comment values (null,'$comment','$maKH','$maDT');");

        Goback();
    }
?>