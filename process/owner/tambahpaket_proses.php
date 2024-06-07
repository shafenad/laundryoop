<?php
require('../../database/koneksi.php');
require('../../database/paket.php');
require('../../database/outlet.php');
session_start();

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_paket'];
    $jenis = $_POST['jenis_paket'];
    $harga = $_POST['harga']; 
    $id_outlet = $_POST['outlet_id'];


    $paketObj = new Paket($conn);


    $paketObj->addPaket($nama, $jenis, $harga, $id_outlet);

    header('Location: ../../pages/owner/paket.php');
    exit();
} else {

    header('Location: ../../pages/owner/paket.php');
    exit();
}
?>
