<?php
require('../../database/koneksi.php');
require('../../database/outlet.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_outlet'];
    $alamat = $_POST['alamat_outlet'];
    $telp = $_POST['telp_outlet'];

    $outletObj = new Outlet($conn);


    $result = $outletObj->addOutlet($nama, $alamat, $telp);

    header('Location: ../../pages/admin/outlet.php');
    exit();
} else {

    header('Location: ../../pages/admin/outlet.php');
    exit();
}
?>
