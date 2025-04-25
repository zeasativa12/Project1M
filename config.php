<?php 

date_default_timezone_set("Asia/Jakarta");

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'db_rekamedis';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

$main_url = "http://localhost/REKAMMEDIS/";

/**
 * Fungsi untuk mengupload gambar ke folder aset/gambar
 */
function uploadGbr($url) {
    $namafile = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $tmp = $_FILES['gambar']['tmp_name'];

    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensifile = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

    if (!in_array($ekstensifile, $ekstensiValid)) {
        echo "<script>
            alert('Input user gagal, file yang Anda upload bukan gambar!');
            window.location = '$url';
        </script>";
        exit;
    }

    if ($ukuran > 1000000) {
        echo "<script>
            alert('Input user gagal, maksimal ukuran gambar 1 MB!');
            window.location = '$url';
        </script>";
        exit;
    }

    $namafileBaru = time() . '-' . $namafile;
    $tujuan = '../aset/gambar/' . $namafileBaru;
    move_uploaded_file($tmp, $tujuan);

    return $namafileBaru;
}

/**
 * Fungsi untuk mengubah format tanggal dari YYYY-MM-DD ke DD-MM-YYYY
 */
function in_date($tgl) {
    $dd = substr($tgl, 8, 2);
    $mm = substr($tgl, 5, 2);
    $yy = substr($tgl, 0, 4);

    return $dd . "-" . $mm . "-" . $yy;
}

?>
