<?php

    require('../../database/koneksi.php');

    require('../../database/pengguna.php');
    session_start();

    $penggunaObj = new Pengguna($conn);


    if(isset($_GET['id'])) {

        $penggunaObj->deleteUser($_GET['id']);


        header('Location: ../../pages/admin/pengguna.php');
        exit();
    } else {

        $_SESSION['msg'] = 'ID Outlet tidak valid!';
        header('Location: ../../pages/admin/pengguna.php');
        exit();
    }
?>
