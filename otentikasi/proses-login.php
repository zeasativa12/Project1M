<?php 

session_start();
require "../config.php"; 

if (isset($_POST['login'])) {     
    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);     
    $password = $_POST['password'];      

    
    $cekuser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

    if (!$cekuser) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($cekuser) === 1) {     
        $row = mysqli_fetch_assoc($cekuser);     

        
        if (password_verify($password, $row['password'])) {
            
            session_regenerate_id(true);

            $_SESSION['ssLoginRM'] = true;  
            $_SESSION['ssUserRM'] = $username;
                   
            mysqli_free_result($cekuser); 
            mysqli_close($koneksi); 

            header("Location: ../index.php");         
            exit();     
        } else {         
            echo "<script>         
                alert('Login gagal, password salah!');         
                document.location.href = 'index.php';         
            </script>";     
        } 
    } else {     
        echo "<script>         
            alert('Login gagal, username tidak ditemukan!');         
            document.location.href = 'index.php';         
        </script>";  
    }

    mysqli_free_result($cekuser); 
    mysqli_close($koneksi); 
}  
?>
