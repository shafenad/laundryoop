<?php

    require('../../database/koneksi.php');

    require('../../database/outlet.php');
    session_start();

    $outletObj = new Outlet($conn);


    if(isset($_GET['id'])) {

        $outletObj->deleteOutlet($_GET['id']);


        header('Location: ../../pages/admin/outlet.php');
        exit();
    } else {

        $_SESSION['msg'] = 'ID Outlet tidak valid!';
        header('Location: ../../pages/admin/outlet.php');
        exit();
    }
?>
