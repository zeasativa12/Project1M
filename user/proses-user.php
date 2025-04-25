<?php  
session_start();

require "../config.php";

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ganti Password
if (isset($_POST['ganti-password'])) {
    $userLogin = $_SESSION['ssUserRM'];

    $oldpass = trim(htmlspecialchars($_POST['oldpass']));
    $newpass = trim(htmlspecialchars($_POST['newpass']));
    $confpass = trim(htmlspecialchars($_POST['confpass']));

    // Ambil data user dari database
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$userLogin'");
    $data = mysqli_fetch_assoc($query);

    // Validasi konfirmasi password
    if ($newpass !== $confpass) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
            window.location = '../otentikasi/password.php';
        </script>";
        exit();
    }

    // Verifikasi password lama
    if (!password_verify($oldpass, $data['password'])) {
        echo "<script>
            alert('Password lama tidak cocok!');
            window.location = '../otentikasi/password.php';
        </script>";
        exit();
    }

    // Update password
    $passBaru = password_hash($newpass, PASSWORD_DEFAULT);
    mysqli_query($koneksi, "UPDATE tbl_user SET password = '$passBaru' WHERE username = '$userLogin'");

    echo "<script>
        alert('Password berhasil diperbarui!');
        window.location = '../otentikasi/password.php';
    </script>";
    exit();
}
?>
