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

$title = "Obat - Rekam Medis";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

// Batasi akses berdasarkan jabatan
if ($dataUser['jabatan'] == 3) {
    echo "<script>
        alert('Halaman tidak ditemukan..');
        window.location = '../index.php';
    </script>";
    exit();
}
if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = ' ';
}

$alert = ' ';
if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><i class="bi bi-bag-check-fill align-top"></i>Hapus Obat berhasil</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
} else if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible fade show updated" role="alert">
  <strong><i class="bi bi-bag-check-fill align-top"></i>Edit Obat berhasil</strong>
  
</div>';
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Obat</h1>
    </div>
    <?php
    if ($msg !== '') {
        echo $alert;
    }
    ?>
    <a href="<?= htmlspecialchars($main_url) ?>obat/tambah-obat.php" 
       class="btn btn-outline-secondary btn-sm mb-3" title="Tambah obat Baru">
        <i class="bi bi-plus-lg align-top"></i> New Medicine
    </a>

    <table class="table table-responsive table-hover" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Kegunaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $queryObat = mysqli_query($koneksi, "SELECT * FROM tbl_obat");

            if (!$queryObat) {
                die("Query Error: " . mysqli_error($koneksi));
            }

            while ($obat = mysqli_fetch_assoc($queryObat)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($obat['nama']); ?></td>
                    <td><?= htmlspecialchars($obat['kegunaan']); ?></td>
                    <td>
                        <a href="edit-obat.php?id=<?= urlencode($obat['id']); ?>" 
                           class="btn btn-sm btn-outline-warning" title="Edit Medicine">
                            <i class="bi bi-pencil align-top"></i>
                        </a>
                        <a href="proses-obat.php?id=<?= urlencode($obat['id']); ?>&aksi=hapus-obat" 
                           onclick="return confirm('Anda yakin ingin menghapus obat ini?')" 
                           class="btn btn-sm btn-outline-danger" title="Hapus Obat">
                            <i class="bi bi-trash align-top"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<script>
    window.setTimeout(function() {
        $('.updated').fadeOut();
    }, 5000)
</script>

<?php
mysqli_free_result($queryObat); // diperbaiki dari $queryPasien
mysqli_close($koneksi);
require "../template/footer.php";
?>
