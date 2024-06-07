<?php
require '../../database/koneksi.php';
require '../../database/transaksi.php';

$title = 'Pembayaran';
$pembayaran = new Transaksi($conn);

$id_transaksi = $_GET['id'];
$data = $pembayaran->getTransaksiById($id_transaksi);

require 'header.php';
?>

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Forms</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="dashboard.php">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="transaksi.php">Transaksi</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="konfirmasi.php">Konfirmasi Pembayaran</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= $title; ?></a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <form name="bayarform" form action="../../process/kasir/bayar_proses.php?id=<?= $data['id_transaksi']; ?>" method="POST" onsubmit="return validateForm()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Kode Invoice</label>
                                <input type="text" name="kode_invoice" class="form-control form-control" id="defaultInput" value="<?= $data['kode_invoice']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" class="form-control form-control" id="defaultInput" value="<?= $data['nama_pelanggan']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Total Yang Harus Dibayarkan</label>
                                <input type="text" name="total_harga" class="form-control form-control" id="defaultInput" value="<?= 'Rp ' . number_format($data['total_harga']); ?>" readonly>
                            </div>
                            <div class="form-group">
                            <label for="largeInput">Masukan Jumlah Pembayaran</label>
                            <input type="number" name="total_bayar" id="total_bayar" class="form-control form-control" id="defaultInput" value="">
                            <?php if (isset($_GET['msg'])) : ?>
                                <small class="text-danger"><?= $_GET['msg'] ?></small>
                            <?php endif ?>
                            </div>
                            <div class="card-action">
                                <button type="submit" name="btn-simpan" class="btn btn-success">Submit</button>
                                <!-- <button class="btn btn-danger">Cancel</button> -->
                                <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-danger">Batal</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../../template/footer.php'; ?>

<script>
    function validateForm() {
        var total_bayar = document.forms["bayarform"]["total_bayar"].value;

        if (total_bayar == "") {
            alert("Jumlah Pembayaran Harus Diisi !");
            return false;
        }
        return true;
    }
</script>