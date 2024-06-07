<?php
session_start(); 


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location:../../index.php');
    exit;
}

$title = 'Tambah Data Outlet';
require '../../database/koneksi.php';
require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <script>
        function validateForm() {
            var nama_outlet = document.forms["outletForm"]["nama_outlet"].value;
            var alamat_outlet = document.forms["outletForm"]["alamat_outlet"].value;
            var telp_outlet = document.forms["outletForm"]["telp_outlet"].value;

            if (nama_outlet == "") {
                alert("Nama Outlet harus diisi");
                return false;
            }

            if (alamat_outlet == "") {
                alert("Alamat Outlet harus diisi");
                return false;
            }

            if (telp_outlet == "") {
                alert("No Telepon harus diisi");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
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
                    <a href="outlet.php">Outlet</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tambah Outlet</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <form name="outletForm" action="../../process/admin/tambahoutlet_proses.php" method="POST" onsubmit="return validateForm()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Nama Outlet</label>
                                <input type="text" name="nama_outlet" class="form-control form-control" id="defaultInput" placeholder="Outlet...">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Outlet</label>
                                <textarea class="form-control" rows="5" name="alamat_outlet"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">No Telepon</label>
                                <input type="number" name="telp_outlet" class="form-control form-control" id="defaultInput" placeholder="No Telp..." maxlength="15">
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

<?php
require '../../template/footer.php';
?>