<?php
session_start(); 


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {

    header('Location:../../index.php');
    exit;
}

$title = 'Tambah Data Paket';
require '../../database/koneksi.php';
require '../../database/outlet.php';
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
                    <a href="paket.php">Paket</a>
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
                    <form name="tambahPaketForm" action="../../process/owner/tambahpaket_proses.php" method="POST" onsubmit="return validateForm()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Nama Paket</label>
                                <input type="text" name="nama_paket" class="form-control" id="defaultInput" placeholder="Paket...">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Jenis Paket</label>
                                <select name="jenis_paket" class="form-control" id="defaultSelect">
                                    <option value="kiloan">Kiloan</option>
                                    <option value="selimut">Selimut</option>
                                    <option value="bedcover">Bedcover</option>
                                    <option value="kaos">Kaos</option>
                                    <option value="lain">Lain</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" name="harga" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Pilih Outlet</label>
                                <?php
                                $outletObj = new Outlet($conn);
                                $data = $outletObj->getAllOutlets();
                                ?>
                                <select name="outlet_id" class="form-control" id="defaultSelect">
                                    <?php while ($key = mysqli_fetch_array($data)) { ?>
                                        <option value="<?= $key['id_outlet']; ?>"><?= $key['nama_outlet']; ?></option>
                                    <?php } ?>
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
        var nama_paket = document.forms["tambahPaketForm"]["nama_paket"].value;
        var jenis_paket = document.forms["tambahPaketForm"]["jenis_paket"].value;
        var harga = document.forms["tambahPaketForm"]["harga"].value;
        var outlet_id = document.forms["tambahPaketForm"]["outlet_id"].value;

        if (nama_paket == "") {
            alert("Nama Paket harus diisi");
            return false;
        }

        if (jenis_paket == "") {
            alert("Jenis Paket harus dipilih");
            return false;
        }

        if (harga == "") {
            alert("Harga harus diisi");
            return false;
        }

        if (outlet_id == "") {
            alert("Pilih Outlet harus dipilih");
            return false;
        }

        return true;
    }
</script>
</body>
</html>