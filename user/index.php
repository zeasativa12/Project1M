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

$title = "User - Rekam Medis";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if ($dataUser['jabatan'] != 1) {
    echo "<script>
        alert('Halaman tidak ditemukan..');
        window.location = '../index.php';
    </script>";
    exit();
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data User</h1>
    </div>

    <a href="<?= htmlspecialchars($main_url) ?>user/tambah-user.php" class="btn btn-outline-secondary btn-sm mb-3" title="Tambah User Baru">
        <i class="bi bi-plus-lg align-top"></i> New User
    </a>

    <table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user");

            if (!$queryUser) {
                die("Query Error: " . mysqli_error($koneksi));
            }

            while ($user = mysqli_fetch_assoc($queryUser)) {
                $jabatan = $user['jabatan'];
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="col-1">
                        <?php if (!empty($user['gambar'])) : ?>
                            <img src="../aset/gambar/<?= htmlspecialchars($user['gambar']) ?>" 
                                 alt="User" class="img-thumbnail rounded-circle img-fluid">
                        <?php else : ?>
                            <img src="../aset/gambar/default.png" 
                                 alt="Default User" class="img-thumbnail rounded-circle img-fluid">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['fullname']) ?></td>
                    <td>
                        <?php
                        switch ($jabatan) {
                            case 1:
                                echo "Administrator";
                                break;
                            case 2:
                                echo "Petugas";
                                break;
                            case 3:
                                echo "Dokter";
                                break;
                            default:
                                echo "Tidak Diketahui";
                        }
                        ?>
                    </td>
                    <td><?= htmlspecialchars($user['alamat']) ?></td>
                    <td>
                        <a href="edit-user.php?id=<?= urlencode($user['userid']) ?>" class="btn btn-sm btn-outline-warning" title="Edit User">
                            <i class="bi bi-pencil align-top"></i>
                        </a>

                        <a href="proses-user.php?id=<?= urlencode($user['userid']) ?>&gambar=<?= urlencode($user['gambar']) ?>&aksi=hapus-user" 
                           onclick="return confirm('Anda yakin ingin menghapus user ini?')" 
                           class="btn btn-sm btn-outline-danger" title="Hapus User">
                            <i class="bi bi-trash align-top"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php
mysqli_free_result($queryUser); // Bebaskan hasil query setelah digunakan
mysqli_close($koneksi); // Tutup koneksi database

require "../template/footer.php";
?>
