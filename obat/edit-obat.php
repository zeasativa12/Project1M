<?php


session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

require "../config.php";
$title = "Edit Obat - Rekam Medis";

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
$id = $_GET['id'];

$queryObat = mysqli_query($koneksi, "SELECT * from tbl_obat where id = $id");
$obat = mysqli_fetch_assoc($queryObat);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Medicine</h1>
        <a href="<?= $main_url ?>obat" 
        class="text-decoration-none">
            <i class="bi bi-arrow-left align-top"></i> Back
        </a>
    </div>

    <form action="proses-obat.php" method="post">
        <div class="row">
            <div class="col-lg-8">
                <input type="hidden" name="id" value="<?= $obat['id']?>">
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control"
                    id="nama" placeholder="Nama obat" value="<?= $obat['nama']?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="kegunaan" class="form-label">kegunaan</label>
                    <textarea name="kegunaan" id="kegunaan" cols="" rows=""
                    class="form-control" placeholder="kegunaan obat" 
                    required><?= $obat['kegunaan']?></textarea>
                </div>
                <button type="submit" name="update" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-save align-top"></i> Update
                </button>
            </div>
        </div>
    </form>

    
</main>

<?php
require "../template/footer.php";
?>
