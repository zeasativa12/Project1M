<?php  
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

$title = "Ganti Password - Rekam Medis";
require "../config.php";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ganti Password</h1>
    </div>

    <div class="card col-md-6">
        <div class="card-body">
            <form action="../user/proses-user.php" method="POST">
                <input type="hidden" name="ganti-password" value="1">

                <div class="mb-3">
                    <label for="oldpass" class="form-label">Password Lama</label>
                    <input type="password" name="oldpass" id="oldpass" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="newpass" class="form-label">Password Baru</label>
                    <input type="password" name="newpass" id="newpass" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="confpass" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="confpass" id="confpass" class="form-control" required>
                </div>

                <div class="text-end">
                    <button type="submit" name="ganti-password" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php  
require "../template/footer.php";
?>
