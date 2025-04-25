<?php


session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

require "../config.php";
$title = "Tambah User - Rekam Medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">New User</h1>
        <a href="<?= $main_url ?>user" class="text-decoration-none">
            <i class="bi bi-arrow-left align-top"></i> Back
        </a>
    </div>

    <form action="proses-user.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4 text-center">
                <div class="px-4 mb-4">
                    <img src="<?= $main_url ?>aset/gambar/default-user.PNG" alt="user" class="img-thumbnail mb-3 rounded-circle tampil" width="120px">
                    <input type="file" class="form-control form-control-sm" name="gambar" onchange="imgview()" id="gambar">
                    <span class="text-sm">Type File Gambar: JPG | PNG | GIF</span><br>
                    <span class="text-sm">Width = Height</span>
                </div>

                <button type="reset" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-x-lg align-top"></i> Reset
                </button>
                <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-save align-top"></i> Save
                </button>
            </div>

            <div class="col-lg-8">
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" autocomplete="off" autofocus required>
                </div>

                <div class="form-group mb-3">
                    <label for="fullname" class="form-label">Fullname</label>
                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan Nama Lengkap User" autocomplete="off" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password User" autocomplete="off" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password2" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Masukkan Kembali Password User" autocomplete="off" required>
                </div>

                <div class="form-group mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-select" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="1">Administrator</option>
                        <option value="2">Petugas</option>
                        <option value="3">Dokter</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="" rows="3" class="form-control" placeholder="Masukkan Alamat User"></textarea>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    function imgview() {
        let gambar = document.getElementById('gambar');
        let tampil = document.querySelector('.tampil');

        let fileReader = new FileReader();  // Fix: Huruf "F" besar pada FileReader
        fileReader.readAsDataURL(gambar.files[0]);

        fileReader.onload = function (e) {
            tampil.src = e.target.result;
        };
    }
</script>

<?php
require "../template/footer.php";
?>
