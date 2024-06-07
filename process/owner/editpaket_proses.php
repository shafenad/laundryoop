<?php
require '../../database/koneksi.php';
require '../../database/paket.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['msg'] = 'Metode request tidak valid!';
    header('Location: ../../pages/owner/paket.php');
    exit();
}


$id_paket = $_POST['id_paket'];
$nama = $_POST['nama_paket'];
$jenis = $_POST['jenis_paket'];
$harga = $_POST['harga']; 
$id_outlet = $_POST['outlet_id'];


$paketObj = new Paket($conn);


$paketObj->updatePaket($id_paket, $nama, $jenis, $harga, $id_outlet);

header('Location: ../../pages/owner/paket.php');
exit();
?>
