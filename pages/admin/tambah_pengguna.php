<?php
session_start(); 


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location:../../index.php');
    exit;
}

$title = 'Tambah Data Pengguna';
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
            var nama_user = document.forms["userForm"]["nama_user"].value;
            var username = document.forms["userForm"]["username"].value;
            var password = document.forms["userForm"]["password"].value;
            var role = document.forms["userForm"]["role"].value;

            if (nama_user == "") {
                alert("Nama Pengguna harus diisi");
                return false;
            }

            if (username == "") {
                alert("Username harus diisi");
                return false;
            }

            if (password == "") {
                alert("Password harus diisi");
                return false;
            }

            if (role == "") {
                alert("Role harus dipilih");
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
                    <a href="pengguna.php">Pengguna</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tambah Pengguna</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <form name="userForm" action="../../process/admin/tambahpengguna_proses.php" method="POST" onsubmit="return validateForm()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Nama Pengguna</label>
                                <input type="text" name="nama_user" class="form-control form-control" id="defaultInput" placeholder="Nama...">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Username</label>
                                <input type="text" name="username" class="form-control form-control" id="defaultInput" placeholder="Username...">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Password</label>
                                <input type="password" name="password" class="form-control form-control" id="defaultInput" placeholder="Pass...">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Role</label>
                                <select name="role" class="form-control form-control" id="defaultSelect">
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="owner">Owner</option>
                                </select>
                            </div>
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
</body>
</html>