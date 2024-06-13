<?php
require 'koneksi.php';
$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');

if (isset($_POST['regis'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_member = $_POST['namaMember'];
    $no_telepon = $_POST['noTelepon'];
    $email = $_POST['email'];

    $q = "INSERT INTO tb_login VALUES('','$username','$password','$nama_member','$no_telepon','$email','user','') ";
    mysqli_query($conn, $q);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>

    alert('Data Berhasil Disimpan');
    document.location.href='index.php';
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login/Register</title>
    <link rel="stylesheet" href="css/login/style-login.css" />
    <style>
        body {
            background-image: url('assets/login/Desain tanpa judul.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <p class="tip">Selamat Datang Di TransPadang</p>
    <img class="logoo" src="assets/login/Blue_Yellow_Modern_Creative_Initial_Font_Logo-removebg-preview.png" alt="logo" width="120px" style="position: absolute; top: 5px; left: 360px" />

    <div class="cont">
        <form action="login.php" method="POST">
            <div class="form sign-in">
                <h2>Silahkan Login</h2>
                <label>
                    <span>Username</span>
                    <input type="type" name="username" />
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" />
                </label>
                <p class="forgot-pass">Forgot password?</p>
                <button type="submit" class="submit" name="signin"><a class="text-signin" href="#">Sign In</a></button>
                <button type="button" class="fb-btn">Connect with <span>Google</span></button>
            </div>
        </form>

        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h2>New here?</h2>
                    <p>Sign up and discover great amount of new opportunities!</p>
                </div>
                <div class="img__text m--in">
                    <h2>One of us?</h2>
                    <p>If you already have an account, just sign in. We've missed you!</p>
                </div>
                <div class="img__btn">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Sign In</span>
                </div>
            </div>

            <form action="" method="POST">
                <div class="form sign-up">
                    <h2>Time to feel like home,</h2>
                    <label>
                        <span>Userame</span>
                        <input type="text" name="username" />
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" />
                    </label>
                    <label>
                        <span>Nama Member</span>
                        <input type="text" name="namaMember" />
                    </label>
                    <label>
                        <span>noTelepon</span>
                        <input type="text" name="noTelepon" />
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" />
                    </label>
                    <button type="submit" class="submit" name="regis">Sign Up</button>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.querySelector(".img__btn").addEventListener("click", function() {
            document.querySelector(".cont").classList.toggle("s--signup");
        });
    </script>
</body>

</html>