<?php
// Include your database connection and other necessary files

include_once '../class/koneksi.php';

// Handle search query
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Query to fetch data
$sql = "SELECT * FROM data_barang";
$sql_count = "SELECT COUNT(*) FROM data_barang";

// Include search condition if applicable
if (!empty($search)) {
    $sql .= " WHERE nama LIKE '%$search%'";
    $sql_count .= " WHERE nama LIKE '%$search%'";
}

$result_count = mysqli_query($conn, $sql_count);
$count = 0;

if ($result_count) {
    $r_data = mysqli_fetch_row($result_count);
    $count = $r_data[0];
}

$per_page = 1;
$num_page = ($per_page > 0) ? ceil($count / $per_page) : 0;
$limit = $per_page;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * $per_page;
} else {
    $offset = 0;
    $page = 1;
}

$sql .= " LIMIT {$offset}, {$limit}";
$result = mysqli_query($conn, $sql);
?>

<div class="container">
    <?php require('../template/header.php'); ?>
    <h2>Data Barang</h2>

    <!-- Search Form -->
    <div class="search-container">
        <form method="get" action="">
            <label for="search">Cari Nama Barang:</label>
            <input type="text" id="search" name="search" placeholder="Masukkan nama barang..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <a class="tambah" href="../module/tambah.php">Tambah Barang</a>

    <div class="main">
        <table>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($result) :
                while ($row = mysqli_fetch_array($result)) :
            ?>
                    <tr>
                        <td><img src="gambar/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>"></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td><?= $row['harga_jual']; ?></td>
                        <td><?= $row['harga_beli']; ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $row['id_barang']; ?>">Ubah</a>
                            <a href="hapus.php?id=<?= $row['id_barang']; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; else : ?>
                <tr>
                    <td colspan="7">Belum ada data</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Pagination Links -->
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <?php
            for ($i = 1; $i <= $num_page; $i++) :
            ?>
                <li>
                    <a class="<?= ($page == $i) ? 'active' : ''; ?>" href="?page=<?= $i ?>&search=<?= $search ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>

</div>
<?php
// Include your footer file
require("../template/footer.php");
?>
