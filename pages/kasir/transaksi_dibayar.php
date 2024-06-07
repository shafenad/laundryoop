<?php
$title = 'Pembayaran';
require 'header.php';
require '../../database/koneksi.php';
require '../../database/transaksi.php';


if (!isset($_GET['id'])) {
    echo "Transaction ID is not provided!";
    exit();
}

$id_transaksi = $_GET['id'];


$transaksi = new Transaksi($conn);


$data = $transaksi->getTransaksiById($id_transaksi);


if (!$data) {
    echo "Transaction not found!";
    exit();
}
?>

<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center" style="padding-left: 50px;padding-right: 50px;">
                                        <div class="bg-success" style="font-size: 30px;border-radius: 30px">
                                            <i class="fa fa-check fa-10x text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center mb-5">
                                        <br>
                                        <h4>Pesanan Atas Nama</h4>
                                        <h2><strong> <?= $data['nama_pelanggan'] ?></strong></h2>
                                        <h4> Berhasil Di Bayar</h4>
                                        <h3><strong>Kode Invoice <?= $data['kode_invoice'] ?></strong><br><br></h3>
                                        <h3><strong>Total Pembayaran <?= 'Rp ' . number_format($data['total_harga']); ?></strong><br></h3>
                                        <h3><strong>Total Uang Bayar <?= 'Rp ' . number_format($data['total_bayar']); ?></strong><br></h3>
                                        <h3><strong>Kembalian <?= 'Rp ' . number_format($data['total_bayar'] - $data['total_harga']); ?></strong><br><br></h3>
                                        <a href="transaksi.php" class="btn btn-primary">Kembali Ke Menu Utama</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../../template/footer.php'; ?>
