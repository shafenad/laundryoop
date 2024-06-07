<?php
require 'koneksi.php';

class Pengguna {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllUsers() {
        $query = 'SELECT * FROM user ORDER BY role DESC';
        return mysqli_query($this->conn, $query);
    }

    public function getAllOutlets() {
        $query = "SELECT * FROM outlet";
        return mysqli_query($this->conn, $query);
    }

    public function addUser($nama, $username, $password, $role) {
        $password = md5($password);
        $query = "INSERT INTO user (nama_user, username, password, role) VALUES ('$nama', '$username', '$password', '$role')";
        $insert = mysqli_query($this->conn, $query);
        if ($insert) {
            $_SESSION['msg'] = 'Berhasil menambahkan ' . $role . ' baru';
            header('location: ../../pages/admin/pengguna.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal menambahkan data!!!';
            header('location: ../../pages/admin/pengguna.php');
            exit();
        }
    }

    public function deleteUser($id) {
        $query = "DELETE FROM user WHERE id_user = $id";
        $delete = mysqli_query($this->conn, $query);
        if ($delete) {
            $_SESSION['msg'] = 'Berhasil Menghapus Data';
            header('location: ../../pages/admin/pengguna.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal Hapus Data!!!';
            header('location: ../../pages/admin/pengguna.php');
            exit();
        }
    }

    public function getUserById($id) {
        $query = "SELECT * FROM user WHERE id_user = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function updateUser($id, $nama, $username, $password, $role) {
        if (!empty($password)) {
            $password = md5($password);
            $query = "UPDATE user SET nama_user = '$nama', username = '$username', role = '$role', password = '$password' WHERE id_user = $id";
        } else {
            $query = "UPDATE user SET nama_user = '$nama', username = '$username', role = '$role' WHERE id_user = $id";
        }
        $update = mysqli_query($this->conn, $query);
        if ($update) {
            $_SESSION['msg'] = 'Berhasil Update ' . $role;
            header('location: ../../pages/admin/pengguna.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal mengupdate data ' . $role . '!!!';
            header('location: ../../pages/admin/pengguna.php');
            exit();
        }
    }
}
?>
