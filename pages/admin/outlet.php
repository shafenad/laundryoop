<?php
session_start(); 


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location:../../index.php');
    exit;
}

$title = 'Data Outlet';
require '../../database/koneksi.php';
require '../../database/outlet.php'; 

$outletObj = new Outlet($conn);


$data = $outletObj->getAllOutlets();

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
                        <a href="tambah_outlet.php" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus"></i>
                            Tambah Outlet
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
                                    <th>Owner</th>
                                    <th>No Telepon</th>
                                    <th style="width: 25%;">Alamat</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($outlet = mysqli_fetch_assoc($data)) {
                                ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $outlet['nama_outlet']; ?></td>
                                            <td><?php if ($outlet['nama_user'] == null) {
                                                    echo "Belum ada owner";
                                                } else {
                                                    echo $outlet['nama_user'];
                                                } ?>
                                            </td>
                                            <td><?= $outlet['telp_outlet']; ?></td>
                                            <td><?= $outlet['alamat_outlet']; ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="edit_outlet.php?id=<?= $outlet['id_outlet']; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="../../process/admin/hapusoutlet_proses.php?id=<?= $outlet['id_outlet']; ?>" onclick="return confirm('Yakin hapus data?');" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus">
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