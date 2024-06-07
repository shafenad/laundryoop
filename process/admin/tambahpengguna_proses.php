<?php
require('../../database/koneksi.php');
require('../../database/pengguna.php');
session_start();

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $role = $_POST['role'];


    $penggunaObj = new Pengguna($conn);

    $penggunaObj->addUser($nama, $username, $password, $role);

    header('Location: ../../pages/admin/pengguna.php');
    exit();
} else {

    header('Location: ../../pages/admin/pengguna.php');
    exit();
}
?>
