<?php

    require('../../database/koneksi.php');

    require('../../database/pelanggan.php');
    session_start();

    $pelangganObj = new Pelanggan($conn);


    if(isset($_GET['id'])) {

        $pelangganObj->deletePelanggan($_GET['id']);


        header('Location: ../../pages/kasir/pelanggan.php');
        exit();
    } else {

        $_SESSION['msg'] = 'ID Outlet tidak valid!';
        header('Location: ../../pages/kasir/pelanggan.php');
        exit();
    }
?>
