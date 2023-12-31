<?php
include_once '../class/koneksi.php';
include_once '../class/config.php';
$id = $_GET['id'];
$sql = "DELETE FROM data_barang WHERE id = '{$id}'";
$result = mysqli_query($conn, $sql);
header('location: index.php');
?>