<?php
session_start();
$title = 'Tambah Data Transaksi';
require '../../database/koneksi.php';
require '../../database/transaksi.php';
require '../../database/outlet.php';
require '../../database/pelanggan.php';
require '../../database/paket.php';

$transaksiObj = new Transaksi($conn);
$outletObj = new Outlet($conn);
$pelangganObj = new Pelanggan($conn);
$paketObj = new Paket($conn);

$id_outlet = $_SESSION['outlet_id'];
$id_user = $_SESSION['user_id'];
$id_pelanggan = $_GET['id'];

$outlet = $outletObj->getOutletById($id_outlet);
$pelanggan = $pelangganObj->getPelangganById($id_pelanggan);
$paket = $paketObj->getPaketByOutletId($id_outlet);


$kode = "CLN" . date('Ymdsi');

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
                    <form name="tambahtransaksiform" form action="../../process/kasir/tambahtransaksi_proses.php" method="POST" onsubmit="return validateForm()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Kode Invoice</label>
                                <input type="text" name="kode_invoice" class="form-control" id="defaultInput" value="<?= $kode; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Outlet</label>
                                <input type="text" name="outlet" class="form-control" id="defaultInput" value="<?= $outlet['nama_outlet']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Pelanggan</label>
                                <input type="text" name="pelanggan" class="form-control" id="defaultInput" value="<?= $pelanggan['nama_pelanggan']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Pilih Paket</label>
                                <select name="id_paket" class="form-control" id="defaultSelect">
                                    <?php while ($key = mysqli_fetch_array($paket)) { ?>
                                        <option value="<?= $key['id_paket']; ?>"><?= $key['nama_paket']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jumlah</label>
                                <input type="number" name="qty" class="form-control" id="defaultInput">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Biaya Tambahan</label>
                                <input type="number" name="biaya_tambahan" class="form-control" id="defaultInput" value="0">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Diskon (%)</label>
                                <input type="number" name="diskon" class="form-control" id="defaultInput" value="0">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Pajak</label>
                                <input type="number" name="pajak" class="form-control" id="defaultInput" value="0">
                            </div>
                            <input type="hidden" name="id_outlet" value="<?= $id_outlet; ?>">
                            <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan; ?>">
                            <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                            <div class="card-action">
                                <button type="submit" name="btn-simpan" class="btn btn-success">Submit</button>
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
        var jumlah = document.forms["tambahtransaksiform"]["qty"].value;

        if (jumlah == "") {
            alert("Jumlah Harus Diisi !");
            return false;
        }

        return true;
    }
</script>