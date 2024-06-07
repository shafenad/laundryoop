<?php
session_start(); 

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'kasir') {
    header('Location:../../index.php');
    exit;
}

$title = 'Data Pelanggan';
require '../../database/koneksi.php';
require '../../database/pelanggan.php'; 


$pelangganObj = new Pelanggan($conn);
$data = $pelangganObj->getAllPelanggan();

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
    <diva class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $title; ?></h4>
                        <a href="tambah_pelanggan.php" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus"></i>
                            Tambah Pelanggan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 7%">#</th>
                                    <th>Nama</th>
                                    <th style="width: 20%;">No KTP</th>
                                    <th style="width: 25%;">Alamat</th>
                                    <th style="width: 15%;">Jenis Kelamin</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($plg = mysqli_fetch_assoc($data)) {
                                ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $plg['nama_pelanggan']; ?></td>
                                            <td><?= $plg['no_ktp']; ?></td>
                                            <td><?= $plg['alamat_pelanggan']; ?></td>
                                            <td><?php if ($plg['jenis_kelamin'] == 'L') {
                                                    echo "Laki-laki";
                                                } else {
                                                    echo "Perempuan";
                                                } ?>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="edit_pelanggan.php?id=<?= $plg['id_pelanggan']; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="../../process/kasir/hapuspelanggan_proses.php?id=<?= $plg['id_pelanggan']; ?>" onclick="return confirm('Yakin hapus data?');" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus">
                                                        <i class="fa fa-times"></i>
                                                    </a>
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
    </script>
</body>
</html>