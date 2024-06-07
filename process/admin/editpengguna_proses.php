<?php
require('../../database/koneksi.php');
require('../../database/pengguna.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $role = $_POST['role'];


    $penggunaObj = new Pengguna($conn);


    if (!empty($password)) {

        $penggunaObj->updateUser($id_user, $nama, $username, $password, $role);
    } else {

        $penggunaObj->updateUser($id_user, $nama, $username, null, $role);
    }
} else {

    $_SESSION['msg'] = 'Invalid request!';
    header('Location: ../../pages/admin/pengguna.php');
    exit();
}
?>
