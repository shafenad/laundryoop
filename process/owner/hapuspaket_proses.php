<?php
    require('../../database/koneksi.php');

    require('../../database/paket.php');
    session_start();

    $paketObj = new Paket($conn);

    if(isset($_GET['id'])) {

        $paketObj->deletePaket($_GET['id']);


        header('Location: ../../pages/owner/paket.php');
        exit();
    } else {

        $_SESSION['msg'] = 'ID Outlet tidak valid!';
        header('Location: ../../pages/owner/paket.php');
        exit();
    }
?>
