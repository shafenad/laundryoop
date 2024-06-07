<?php
session_start();
require '../../database/koneksi.php';
require '../../database/transaksi.php';

if (isset($_POST['btn-simpan'])) {
    $transaksiObj = new Transaksi($conn);

    $data = [
        'kode_invoice' => $_POST['kode_invoice'],
        'id_outlet' => $_POST['id_outlet'],
        'id_pelanggan' => $_POST['id_pelanggan'],
        'biaya_tambahan' => $_POST['biaya_tambahan'],
        'diskon' => $_POST['diskon'],
        'pajak' => $_POST['pajak'],
        'id_user' => $_POST['id_user'],
        'id_paket' => $_POST['id_paket'],
        'qty' => $_POST['qty']
    ];

    $id_transaksi = $transaksiObj->tambahTransaksi($data);

    if ($id_transaksi) {
        header('location:../../pages/kasir/transaksi_sukses.php?id=' . $id_transaksi);
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Gagal transaksi!!!</div>";
        header('location:../../pages/kasir/tambah_transaksi.php');
    }
    exit();
}
?>
