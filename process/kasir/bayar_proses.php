<?php
require '../../database/koneksi.php';
require '../../database/transaksi.php';

$pembayaran = new Transaksi($conn);

if (!isset($_GET['id'])) {
    echo "Transaction ID is not provided!";
    exit();
}

$id_transaksi = $_GET['id'];

if (isset($_POST['btn-simpan'])) {
    $total_bayar = $_POST['total_bayar'];
    
    $result = $pembayaran->bayarTransaksi($id_transaksi, $total_bayar);
    
    if ($result === true) {
        header('location: ../../pages/kasir/transaksi_dibayar.php?id=' . $id_transaksi);
        exit();
    } else {
        $msg = "Jumlah Uang Pembayaran Kurang";
        header('location: ../../pages/kasir/bayar.php?id=' . $id_transaksi . '&msg=' . $msg);
        exit();
    }
} else {
    header('location: ../../pages/kasir/transaksi.php');
    exit();
}
?>
