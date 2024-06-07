<?php
session_start(); 

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'kasir') {
    header('Location:../../index.php');
    exit;
}

$title = 'Tambah Data Pelanggan';
require '../../database/koneksi.php';
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
                    <a href="pelanggan.php">Pelanggan</a>
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
                    <form name="tambahPelangganForm" action="../../process/kasir/tambahpelanggan_proses.php" method="POST" onsubmit="return validateForm()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">No KTP Pelanggan</label>
                                <input type="number" name="no_ktp" class="form-control" id="defaultInput" placeholder="No KTP..." maxlength="20">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" class="form-control" id="defaultInput" placeholder="Nama...">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Pelanggan</label>
                                <textarea class="form-control" rows="5" name="alamat_pelanggan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">No Telepon</label>
                                <input type="number" name="telp_pelanggan" class="form-control" id="defaultInput" placeholder="No Telp...">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="defaultSelect">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="card-action">
                                <button type="submit" name="btn-simpan" class="btn btn-success">Submit</button>
                                <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-danger">Batal</a>
                            </div>
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
        var no_ktp = document.forms["tambahPelangganForm"]["no_ktp"].value;
        var nama_pelanggan = document.forms["tambahPelangganForm"]["nama_pelanggan"].value;
        var alamat_pelanggan = document.forms["tambahPelangganForm"]["alamat_pelanggan"].value;
        var telp_pelanggan = document.forms["tambahPelangganForm"]["telp_pelanggan"].value;
        var jenis_kelamin = document.forms["tambahPelangganForm"]["jenis_kelamin"].value;

        if (no_ktp == "") {
            alert("No KTP Pelanggan harus diisi");
            return false;
        }

        if (nama_pelanggan == "") {
            alert("Nama Pelanggan harus diisi");
            return false;
        }

        if (alamat_pelanggan == "") {
            alert("Alamat Pelanggan harus diisi");
            return false;
        }

        if (telp_pelanggan == "") {
            alert("No Telepon harus diisi");
            return false;
        }

        if (jenis_kelamin == "") {
            alert("Jenis Kelamin harus dipilih");
            return false;
        }

        return true;
    }
</script>
</body>
</html>