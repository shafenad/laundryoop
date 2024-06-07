<?php
$title = 'Edit Data Pengguna';
require '../../database/koneksi.php';
require '../../database/pengguna.php';
session_start();


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location:../../index.php');
    exit;
}


if (!isset($_GET['id'])) {
    $_SESSION['msg'] = 'ID Pengguna tidak ditemukan!';
    header('Location: pengguna.php');
    exit();
}

$penggunaId = $_GET['id'];


$penggunaObj = new Pengguna($conn);


$edit = $penggunaObj->getUserById($penggunaId);

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
            var nama_user = document.forms["editUserForm"]["nama_user"].value;
            var username = document.forms["editUserForm"]["username"].value;
            var password = document.forms["editUserForm"]["password"].value;
            var role = document.forms["editUserForm"]["role"].value;

            if (nama_user == "") {
                alert("Nama Pengguna harus diisi");
                return false;
            }

            if (username == "") {
                alert("Username harus diisi");
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
                    <a href="#">Edit Pengguna</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <form name="editUserForm" action="../../process/admin/editpengguna_proses.php" method="POST" onsubmit="return validateForm()">
                            <div class="card-body">
                                 
                                 <input type="hidden" name="id_user" value="<?= $edit['id_user']; ?>">
                                <div class="form-group">
                                    <label for="largeInput">Nama Pengguna</label>
                                    <input type="text" name="nama_user" class="form-control form-control" id="defaultInput" value="<?= $edit['nama_user']; ?>" placeholder="Nama...">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Username</label>
                                    <input type="text" name="username" class="form-control form-control" id="defaultInput" value="<?= $edit['username']; ?>" placeholder="Username...">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Password</label>
                                    <input type="password" name="password" class="form-control form-control" id="defaultInput">
                                    <small>Kosongkan jika tidak melakukan perubahan password</small>
                                </div>
                                <div class="form-group">
                                    <label for="defaultSelect">Role</label>
                                    <select name="role" class="form-control form-control" id="defaultSelect">
                                    <option value="admin" <?= ($edit['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="kasir" <?= ($edit['role'] == 'kasir') ? 'selected' : ''; ?>>Kasir</option>
                                    <option value="owner" <?= ($edit['role'] == 'owner') ? 'selected' : ''; ?>>Owner</option>
                                </select>
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
<?php require '../../template/footer.php';

