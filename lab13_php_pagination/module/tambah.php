<?php
error_reporting(E_ALL);
include_once '../class/koneksi.php';
include_once '../class/config.php';

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $sql = 'INSERT INTO data_mahasiswa (nim, nama, alamat) ';
    $sql .= "VALUES ('{$nim}', '{$nama}', '{$alamat}')";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
?>

<div class="container">
    <?php require('../template/header.php'); ?>
    <h1>Tambah Mahasiswa</h1>
    <div class="main">
        <form method="post" action="tambah.php">
            <div class="input">
                <label>NIM</label>
                <input type="text" name="nim" />
            </div>
            <div class="input">
                <label>Nama Mahasiswa</label>
                <input type="text" name="nama" />
            </div>
            <div class="input">
                <label>Alamat</label>
                <input type="text" name="alamat" />
            </div>
            <div class="submit">
                <input type="submit" name="submit" value="Simpan" />
            </div>
        </form>
    </div>
    <br>
    <br>
    <?php require('../template/footer.php'); ?>
</div>
