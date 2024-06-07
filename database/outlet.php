<?php
require 'koneksi.php';

class Outlet {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllOutlets() {
        $query = 'SELECT outlet.*, user.nama_user FROM outlet LEFT JOIN user ON user.outlet_id = outlet.id_outlet';
        return mysqli_query($this->conn, $query);
    }

    public function getOutletById($id) {
        $query = "SELECT outlet.*, user.nama_user, user.id_user FROM outlet LEFT JOIN user ON user.outlet_id = outlet.id_outlet WHERE id_outlet = $id";
        $data = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($data);
    }


    public function addOutlet($nama, $alamat, $telp) {
        $query = "INSERT INTO outlet (nama_outlet, alamat_outlet, telp_outlet) VALUES ('$nama', '$alamat', '$telp')";
        $insert = mysqli_query($this->conn, $query);
        if ($insert) {
            $_SESSION['msg'] = 'Berhasil Menyimpan Data';
            header('location: ../../pages/admin/outlet.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal menambahkan data baru!!!';
            header('location: ../../pages/admin/outlet.php');
            exit();
        }
    }

    public function updateOutlet($id, $nama, $alamat, $telp) {
        $query = "UPDATE outlet SET nama_outlet = '$nama', alamat_outlet = '$alamat', telp_outlet = '$telp' WHERE id_outlet = $id";
        $update = mysqli_query($this->conn, $query);

        if ($update) {
            $_SESSION['msg'] = 'Berhasil Mengubah Data';
            header('location: ../../pages/admin/outlet.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal Mengubah Data!!!';
            header('location: ../../pages/admin/outlet.php');
            exit();
        }
    }
    
    

    public function deleteOutlet($id) {
        $query = "DELETE FROM outlet WHERE id_outlet = $id";
        $delete = mysqli_query($this->conn, $query);

        if ($delete) {
            $_SESSION['msg'] = 'Berhasil Menghapus Data';
            header('location: ../../pages/admin/outlet.php');
            exit();
        } else {
            $_SESSION['msg'] = 'Gagal Hapus Data!!!';
            header('location: ../../pages/admin/outlet.php');
            exit();
        }
    }


}
?>
