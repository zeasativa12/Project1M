<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

require "../config.php";
$title = "Edit Pasien - Rekam Medis";

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
$queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien WHERE id = '$id'");
$pasien = mysqli_fetch_assoc($queryPasien);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Patient</h1>
        <a href="<?= $main_url ?>pasien" class="text-decoration-none">
            <i class="bi bi-arrow-left align-top"></i> Back
        </a>
    </div>

    <form action="proses-pasien.php" method="post">
        <div class="row">
            <div class="col-lg-8">
                <input type="hidden" name="id" value="<?= $pasien['id'] ?>">

                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama pasien" value="<?= $pasien['nama'] ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" value="<?= $pasien['tgl_lahir'] ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_pria" value="P" required <?= ($pasien['gender'] == 'P') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="gender_pria">Pria</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_wanita" value="W" <?= ($pasien['gender'] == 'W') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="gender_wanita">Wanita</label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="telpon" class="form-label">Telpon / HP</label>
                    <input type="tel" name="telpon" id="telpon" placeholder="Telpon pasien" pattern="[0-9]{8,}" title="Minimal 8 angka" class="form-control" value="<?= $pasien['telpon'] ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat pasien" required><?= $pasien['alamat'] ?></textarea>
                </div>

                <button type="submit" name="update" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-save align-top"></i> Update
                </button>
            </div>
        </div>
    </form>
</main>

<?php require "../template/footer.php"; ?>
