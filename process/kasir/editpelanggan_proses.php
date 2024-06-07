<?php
require '../../database/koneksi.php';
require '../../database/pelanggan.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['msg'] = 'Metode request tidak valid!';
    header('Location: ../../pages/kasir/pelanggan.php');
    exit();
}


$id_pelanggan = $_POST['id_pelanggan'];
$nama = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat_pelanggan'];
$no_ktp = $_POST['no_ktp'];
$telp = $_POST['telp_pelanggan'];
$jenis_kelamin = $_POST['jenis_kelamin'];


$pelangganObj = new Pelanggan($conn);


$pelangganObj->updatePelanggan($id_pelanggan, $nama, $alamat, $no_ktp, $telp, $jenis_kelamin);

header('Location: ../../pages/kasir/pelanggan.php');
exit();
?>
