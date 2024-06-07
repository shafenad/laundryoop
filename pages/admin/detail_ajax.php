<?php
require '../../database/koneksi.php';
require '../../database/transaksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $transaksiObj = new Transaksi($conn);
    $data = $transaksiObj->getDetailTransaksiById($id);

    if ($data) {
        ?>
        <div class="form-group">
            <label for="largeInput">Kode Invoice</label>
            <input type="text" name="kode_invoice" class="form-control form-control" id="defaultInput" value="<?= $data['kode_invoice']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="largeInput">Outlet</label>
            <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_outlet']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="largeInput">Pelanggan</label>
            <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_pelanggan']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="largeInput">Jenis Paket</label>
            <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_paket']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="largeInput">Jumlah</label>
            <input type="text" name="qty" class="form-control form-control" id="defaultInput" value="<?= $data['qty']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="largeInput">Total Harga</label>
            <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['total_harga']; ?>" readonly>
        </div>
        <?php if ($data['total_bayar'] > 0) : ?>
            <div class="form-group">
                <label for="largeInput">Total Bayar</label>
                <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['total_bayar']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="largeInput">Tanggal Dibayar</label>
                <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['tgl_pembayaran']; ?>" readonly>
            </div>
        <?php else : ?>
            <div class="form-group">
                <label for="largeInput">Total Bayar</label>
                <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="Belum Melakukan Pembayaran" readonly>
            </div>
            <div class="form-group">
                <label for="largeInput">Batas Waktu Pembayaran</label>
                <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['batas_waktu']; ?>" readonly>
            </div>
        <?php endif; ?>
        <?php
    } else {
        echo '<p>Transaksi tidak ditemukan.</p>';
    }
} else {
    echo '<p>ID transaksi tidak diberikan.</p>';
}
?>
