<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("Location: ../otentikasi/index.php");
    exit();
}

require "../config.php";

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$title = "Pasien - Rekam Medis";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if ($dataUser['jabatan'] == 3) {
    echo "<script>
        alert('Halaman tidak ditemukan..');
        window.location = '../index.php';
    </script>";
    exit();
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Patient</h1>
    </div>

    <a href="<?= htmlspecialchars($main_url) ?>pasien/tambah-pasien.php" 
       class="btn btn-outline-secondary btn-sm mb-3" title="Tambah Pasien Baru">
        <i class="bi bi-plus-lg align-top"></i> New Patient
    </a>

    <table class="table table-responsive table-hover" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pasien</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Telpon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien");

            if (!$queryPasien) {
                die("Query Error: " . mysqli_error($koneksi));
            }

            while ($pasien = mysqli_fetch_assoc($queryPasien)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $pasien['id']; ?></td>
                    <td><?= $pasien['nama']; ?></td>
                    <td><?= in_date($pasien['tgl_lahir']) ?></td>
                    <td>
                        <?= $pasien['gender'] === 'P' ? 'Pria' : 'Wanita'; ?>
                    </td>
                    <td><?= $pasien['telpon']; ?></td>
                    <td><?= $pasien['alamat']; ?></td>
                    <td>
                        <a href="edit-pasien.php?id=<?= urlencode($pasien['id']); ?>" 
                           class="btn btn-sm btn-outline-warning" title="Edit Patient">
                            <i class="bi bi-pencil align-top"></i>
                        </a>
                        <a href="proses-pasien.php?id=<?= urlencode($pasien['id']); ?>&aksi=hapus-pasien" 
                           onclick="return confirm('Anda yakin ingin menghapus pasien ini?')" 
                           class="btn btn-sm btn-outline-danger" title="Hapus Pasien">
                            <i class="bi bi-trash align-top"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php
mysqli_free_result($queryPasien);
mysqli_close($koneksi);
require "../template/footer.php";
?>
