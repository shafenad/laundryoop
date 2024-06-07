<?php
require 'koneksi.php';

class Pelanggan {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllPelanggan() {
        $query = "SELECT * FROM pelanggan";
        return mysqli_query($this->conn, $query);
    }

    public function addPelanggan($nama, $alamat, $no_ktp, $telp, $jenis_kelamin) {
        $query = "INSERT INTO pelanggan (nama_pelanggan, alamat_pelanggan, no_ktp, telp_pelanggan, jenis_kelamin) 
                  VALUES ('$nama', '$alamat', '$no_ktp', '$telp', '$jenis_kelamin')";
        $insert = mysqli_query($this->conn, $query);
        if ($insert) {
            $_SESSION['msg'] = 'Berhasil menambahkan pelanggan baru';
            header('location:../../pages/kasir/pelanggan.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal menambahkan data baru!!!';
            header('location:../../pages/kasir/pelanggan.php');
            exit();
        }
    }

    public function deletePelanggan($id) {
        $query = "DELETE FROM pelanggan WHERE id_pelanggan = $id";
        $delete = mysqli_query($this->conn, $query);
        if ($delete) {
            $_SESSION['msg'] = 'Berhasil menghapus data pelanggan';
            header('location:../../pages/kasir/pelanggan.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal Hapus Data!!!';
            header('location:../../pages/kasir/pelanggan.php');
            exit();
        }
    }

    public function getPelangganById($id) {
        $query = "SELECT * FROM pelanggan WHERE id_pelanggan = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function updatePelanggan($id, $nama, $alamat, $no_ktp, $telp, $jenis_kelamin) {
        $query = "UPDATE pelanggan SET nama_pelanggan = '$nama', alamat_pelanggan = '$alamat', no_ktp = '$no_ktp', 
                  telp_pelanggan = '$telp', jenis_kelamin = '$jenis_kelamin' WHERE id_pelanggan = $id";
        $update = mysqli_query($this->conn, $query);
        if ($update) {
            $_SESSION['msg'] = 'Berhasil mengubah data pelanggan';
            header('location:../../pages/kasir/pelanggan.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal mengubah data!!!';
            header('location:../../pages/kasir/pelanggan.php');
            exit();
        }
    }
}

?>