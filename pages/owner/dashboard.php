<?php
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {
    header('Location:../../index.php');
    exit;
}

$title = 'Selamat Datang di Aplikasi Pengelolaan Laundry';
require '../../database/koneksi.php';
require 'header.php';

setlocale(LC_ALL, 'id_id');
setlocale(LC_TIME, 'id_ID.utf8');
?>

<div class="panel-header bg-secondary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h1 class="text-white pb-2 fw-bold"><?= $title; ?></h1>
                <h2 class="text-white op-7 mb-2">Owner Dashboard</h2>
            </div>
        </div>
    </div>
</div>
</div>
<?php
require '../../template/footer.php';
?>
