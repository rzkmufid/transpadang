<?php
include 'koneksi.php';
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = mysqli_query($conn, "SELECT * FROM tb_login WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);

        if ($data['posisi'] == "admin") {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['posisi'] = "admin";

            header("location: beranda_admin.php");
        } else if ($data['posisi'] == "user") {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['posisi'] = "user";

            // echo $username;



            header("location: beranda_user.php");
        }
    } else {
        echo "<script>
        alert('Login gagal');
        document.location.href='index.php';
        </script>";
    }
}
