<?php
session_start();


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {

    header('Location:../../index.php');
    exit;
}

$title = 'Data Transaksi';
require '../../database/koneksi.php';
require '../../database/transaksi.php'; 

$transaksiObj = new Transaksi($conn);
$data = $transaksiObj->getAllTransaksi();

require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Menggunakan stylesheet dan script yang sudah ada di template -->
    <link rel="stylesheet" href="../../assets/css/atlantis.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables.min.css">
    <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $title; ?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 7%">#</th>
                                    <th>Kode</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th>
                                    <th>Total</th>
                                    <th style="width: 5%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($trans = mysqli_fetch_assoc($data)) {
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $trans['kode_invoice']; ?></td>
                                            <td><?= $trans['nama_pelanggan']; ?></td>
                                            <td><?= $trans['status']; ?></td>
                                            <td><?= $trans['status_bayar']; ?></td>
                                            <td><?= 'Rp ' . number_format($trans['total_harga']); ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button onclick="showDetail(<?= $trans['id_transaksi']; ?>)" type="button" data-toggle="tooltip" title="Detail" class="btn btn-primary">
                                                        <i class="far fa-eye"></i> Detail
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Detail content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
require '../../template/footer.php';
?>

<!-- Inisialisasi DataTables -->
<script>
$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable('#basic-datatables')) {
        $('#basic-datatables').DataTable({
            "searching": true,
            "paging": true,
            "info": true
        });
    }
});

function showDetail(id) {
    $.ajax({
        url: 'detail_ajax.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            $('#detailModal .modal-body').html(response);
            $('#detailModal').modal('show');
        },
        error: function() {
            alert('Terjadi kesalahan saat mengambil data detail.');
        }
    });
}
</script>
</body>
</html>
