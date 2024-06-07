<?php
require 'koneksi.php';

class Paket {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllPaket() {
        $query = "SELECT outlet.nama_outlet, paket_cuci.* 
                  FROM paket_cuci 
                  INNER JOIN outlet ON paket_cuci.outlet_id = outlet.id_outlet";
        return mysqli_query($this->conn, $query);
    }

    public function getAllOutlets() {
        $query = "SELECT * FROM outlet";
        return mysqli_query($this->conn, $query);
    }

    public function getPaketById($id) {
        $query = "SELECT * FROM paket_cuci WHERE id_paket = '$id'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getPaketByOutletId($id_outlet) {
        $query = "SELECT * FROM paket_cuci WHERE outlet_id = '$id_outlet'";
        return mysqli_query($this->conn, $query);
    }

    public function addPaket($nama, $jenis, $harga, $id_outlet) {
        $query = "INSERT INTO paket_cuci (nama_paket, jenis_paket, harga, outlet_id) 
                  VALUES ('$nama', '$jenis', '$harga', '$id_outlet')";
        $insert = mysqli_query($this->conn, $query);
        if ($insert) {
            $_SESSION['msg'] = 'Berhasil tambah paket baru';
            header('location: ../../pages/owner/paket.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal menambahkan data baru';
            header('location: ../../pages/owner/paket.php');
            exit();
        }
    }

    public function updatePaket($id, $nama, $jenis, $harga, $id_outlet) {
        $query = "UPDATE paket_cuci SET 
                  nama_paket = '$nama', jenis_paket = '$jenis', harga = '$harga', outlet_id = '$id_outlet' 
                  WHERE id_paket = '$id'";
        $update = mysqli_query($this->conn, $query);
        if ($update) {
            $_SESSION['msg'] = 'Berhasil mengubah data';
            header('location: ../../pages/owner/paket.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal mengubah data!!!';
            header('location: ../../pages/owner/paket.php');
            exit();
        }
    }

    public function deletePaket($id) {
        $query = "DELETE FROM paket_cuci WHERE id_paket = '$id'";
        $delete = mysqli_query($this->conn, $query);
        if ($delete) {
            $_SESSION['msg'] = 'Berhasil menghapus data';
            header('location: ../../pages/owner/paket.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal Hapus Data!!!';
            header('location: ../../pages/owner/paket.php');
            exit();
        }
    }
}
?>
