<?php
include("../class/koneksi.php");
include("../class/config.php");

// query untuk menampilkan data
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Praktikum 10</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="container">
        <header>
            <h1>Pendefinisian Class dan Pemanggilan Class</h1>
        </header>
        <nav>
            <a href="../module/index.php">Home</a>
            <a href="../module/about.php">About</a>
            <a href="../module/kontak.php">Contact</a>
        </nav>