<?php
require('../../database/koneksi.php');
require('../../database/pelanggan.php');
session_start();

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat_pelanggan'];
    $no_ktp = $_POST['no_ktp']; 
    $telp = $_POST['telp_pelanggan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];


    $pelangganObj = new Pelanggan($conn);


    $pelangganObj->addPelanggan($nama, $alamat, $no_ktp, $telp, $jenis_kelamin);

    header('Location: ../../pages/kasir/pelanggan.php');
    exit();
} else {

    header('Location: ../../pages/kasir/pelanggan.php');
    exit();
}
?>