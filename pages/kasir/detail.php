<?php
session_start(); 


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'kasir') {
    header('Location:../../index.php');
    exit;
}

$title = 'Detail Transaksi';
require '../../database/koneksi.php';
require '../../database/transaksi.php'; 


$transaksiObj = new Transaksi($conn);

$id_transaksi = $_GET['id'];

if (!$id_transaksi) {
    $_SESSION['msg'] = 'ID Transaksi tidak valid';
    header('location: transaksi.php');
    exit();
}

$data = $transaksiObj->getDetailTransaksiById($id_transaksi);

require 'header.php';
?>


<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Forms</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="index.php">
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
                    <form name="detailform" form action="../../process/kasir/detail_proses.php" method="POST" onsubmit="return validateForm()">
                    <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi']; ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Kode Invoice</label>
                                <input type="text" name="kode_invoice" class="form-control form-control" id="defaultInput" value="<?= $data['kode_invoice']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Outlet</label>
                                <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_outlet']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Pelanggan</label>
                                <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_pelanggan']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jenis_paket</label>
                                <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_paket']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jumlah</label>
                                <input type="text" name="qty" class="form-control form-control" id="defaultInput" value="<?= $data['qty']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Total Harga</label>
                                <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['total_harga']; ?>" readonly>
                            </div>
                            <?php if ($data['total_bayar'] > 0) : ?>
                                <div class="form-group">
                                    <label for="largeInput">Total Bayar</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['total_bayar']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Tanggal Dibayar</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['tgl_pembayaran']; ?>" readonly>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <label for="largeInput">Total Bayar</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="Belum Melakukan Pembayaran" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Batas Waktu Pembayaran</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['batas_waktu']; ?>" readonly>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="">Status Transaksi</label>
                                <select name="status" class="form-control form-control" id="defaultSelect">
                                <option value="baru" <?= ($data['status'] == 'baru') ? 'selected' : ''; ?>>baru</option>
                                <option value="proses" <?= ($data['status'] == 'proses') ? 'selected' : ''; ?>>proses</option>
                                <option value="selesai" <?= ($data['status'] == 'selesai') ? 'selected' : ''; ?>>selesai</option>
                                <option value="diambil" <?= ($data['status'] == 'diambil') ? 'selected' : ''; ?>>diambil</option>
                            </select>
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
        var status = document.forms["detailform"]["status"].value;

        if (status == "") {
            alert("Status Harus Diisi !");
            return false;
        }
        return true;
    }
</script>