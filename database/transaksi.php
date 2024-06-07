<?php
require 'koneksi.php';

class Transaksi {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllTransaksi() {
        $query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga 
                  FROM transaksi 
                  INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan 
                  INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi";
        return mysqli_query($this->conn, $query);
    }

    public function getTransaksiById($id) {
        $query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga, detail_transaksi.total_bayar 
                  FROM transaksi 
                  INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan 
                  INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi 
                  WHERE transaksi.id_transaksi = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getDetailTransaksiById($id) {
        $query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.*, outlet.nama_outlet, paket_cuci.nama_paket 
                  FROM transaksi 
                  INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan 
                  INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi 
                  INNER JOIN outlet ON outlet.id_outlet = transaksi.outlet_id 
                  INNER JOIN paket_cuci ON paket_cuci.outlet_id = transaksi.outlet_id 
                  WHERE transaksi.id_transaksi = '$id'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function updateStatusTransaksi($id, $status) {
        $query = "UPDATE transaksi SET status = '$status' WHERE id_transaksi = '$id'";
        $update = mysqli_query($this->conn, $query);
        return $update;
    }

    public function bayarTransaksi($id, $total_bayar) {
        $query = "SELECT * FROM transaksi INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_transaksi = $id";
        $result = mysqli_query($this->conn, $query);
        $data = mysqli_fetch_assoc($result);
    
        if ($total_bayar >= $data['total_harga']) {
            $query1 = "UPDATE transaksi SET status_bayar = 'dibayar', tgl_pembayaran = '" . date('Y-m-d H:i:s') . "' WHERE id_transaksi = $id";
            $query2 = "UPDATE detail_transaksi SET total_bayar = '$total_bayar' WHERE id_transaksi = $id";
    
            $update1 = mysqli_query($this->conn, $query1);
            $update2 = mysqli_query($this->conn, $query2);
    
            if ($update1 && $update2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    

    
    public function getUnpaidTransactions() {
        $query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga 
                  FROM transaksi 
                  INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan 
                  INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi 
                  WHERE transaksi.status_bayar = 'belum'";
        return mysqli_query($this->conn, $query);
    }

    public function getAllTransactionsForReport() {
        $query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga, outlet.nama_outlet 
                  FROM transaksi 
                  INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan 
                  INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi 
                  INNER JOIN outlet ON outlet.id_outlet = transaksi.outlet_id";
        return mysqli_query($this->conn, $query);
    }
    
    public function tambahTransaksi($data) {
        $tgl = date('Y-m-d h:i:s');
        $seminggu = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
        $batas_waktu = date("Y-m-d h:i:s", $seminggu);
        $kode_invoice = $data['kode_invoice'];
        $id_outlet = $data['id_outlet'];
        $id_pelanggan = $data['id_pelanggan'];
        $biaya_tambahan = $data['biaya_tambahan'];
        $diskon = $data['diskon'];
        $pajak = $data['pajak'];
        $id_user = $data['id_user'];
        $id_paket = $data['id_paket'];
        $qty = $data['qty'];

        $query = "INSERT INTO transaksi (outlet_id, kode_invoice, id_pelanggan, tgl, batas_waktu, biaya_tambahan, diskon, pajak, status, status_bayar, id_user) 
                  VALUES ('$id_outlet', '$kode_invoice', '$id_pelanggan', '$tgl', '$batas_waktu', '$biaya_tambahan', '$diskon', '$pajak', 'baru', 'belum', '$id_user')";
        $insert = mysqli_query($this->conn, $query);

        if ($insert) {
            $id_transaksi = mysqli_insert_id($this->conn);
            $query_paket = mysqli_query($this->conn, "SELECT * FROM paket_cuci WHERE id_paket = $id_paket");
            $paket_harga = mysqli_fetch_assoc($query_paket);
            $total = $paket_harga['harga'] * $qty;

            $query_detail = "INSERT INTO detail_transaksi (id_transaksi, id_paket, qty, total_harga) VALUES ('$id_transaksi', '$id_paket', '$qty', '$total')";
            $insert_detail = mysqli_query($this->conn, $query_detail);

            return $insert_detail ? $id_transaksi : false;
        }

        return false;
    }
    
    public function hapusTransaksi($id) {
        $query = "DELETE FROM detail_transaksi WHERE id_transaksi = $id";
        $delete_detail = mysqli_query($this->conn, $query);
    
        if ($delete_detail) {
            $query2 = "DELETE FROM transaksi WHERE id_transaksi = $id";
            $delete_transaksi = mysqli_query($this->conn, $query2);
    
            return $delete_transaksi ? true : false;
        }
    
        return false;
    }
    
    
    public function getTransaksiSuksesById($id) {
        $query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga 
                  FROM transaksi 
                  INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan 
                  INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi 
                  WHERE transaksi.id_transaksi = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }


}
?>
