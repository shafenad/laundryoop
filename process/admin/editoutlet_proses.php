<?php
require '../../database/koneksi.php';
require '../../database/outlet.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['msg'] = 'Metode request tidak valid!';
    header('Location: ../../pages/admin/outlet.php');
    exit();
}

$id_outlet = $_POST['id_outlet'];
$nama = $_POST['nama_outlet'];
$alamat = $_POST['alamat_outlet'];
$telp = $_POST['telp_outlet'];


$outletObj = new Outlet($conn);


$outletObj->updateOutlet($id_outlet, $nama, $alamat, $telp);

header('Location: ../../pages/admin/outlet.php');
exit();
?>
