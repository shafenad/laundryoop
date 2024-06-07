<?php
session_start();
require '../../database/koneksi.php';
require '../../database/transaksi.php';

if (isset($_POST['btn-simpan'])) {
    $id = $_POST['id_transaksi'];
    $status = $_POST['status'];

    $transaksiDetail = new Transaksi($conn);
    $update = $transaksiDetail->updateStatusTransaksi($id, $status);

    if ($update) {
        $_SESSION['msg'] = 'Berhasil mengubah status transaksi';
    } else {
        $_SESSION['msg'] = 'Gagal mengubah status transaksi';
    }
    header('location: ../../pages/kasir/transaksi.php');
    exit();
}
?>
