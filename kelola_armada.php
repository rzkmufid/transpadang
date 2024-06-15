<?php
session_start();

// Periksa apakah pengguna belum login
if (!isset($_SESSION['username'])) {
    // Redirect ke halaman login atau tindakan lain yang sesuai
    header("Location: index.php");
    exit();
}
require 'koneksi.php';
$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');

if (isset($_POST['armada'])) {
    $plat_bus = $_POST['platBus'];
    $awal_halte = $_POST['awalHalte'];
    $tujuan_akhir = $_POST['tujuanAkhir'];
    $koridor_bus = $_POST['koridorBus'];
    $jam_awal = $_POST['jamAwal'];
    $jam_akhir = $_POST['jamAkhir'];

    $q = "INSERT INTO tb_bus VALUES('$plat_bus','','$awal_halte','$tujuan_akhir','$koridor_bus','$jam_awal','$jam_akhir') ";
    mysqli_query($conn, $q);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>

    alert('Data Bus Berhasil Disimpan');
    document.location.href='kelola_armada.php';
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="css/admin/style-berandaAdmin.css">

    <title>AdminHub</title>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Admin Trans Padang</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="beranda_admin.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Beranda</span>
                </a>
            </li>
            <li>
                <a href="kelola_pemesanan.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Kelola Pemesanan</span>
                </a>
            </li>
            <li>
                <a href="penjualan.php">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Penjualan</span>
                </a>
            </li>
            <li>
                <a href="member.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Member</span>
                </a>
            </li>
            <li class="active">
                <a href="kelola_armada.php">
                    <i class='bx bxs-bus'></i>
                    <span class="text">Kelola Armada</span>
                </a>
            </li>
            <li>
                <a href="bus.php">
                    <i class='bx bxs-bus'></i>
                    <span class="text">Bus</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="assets/admin/Logo.png" alt="Profile">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main class="kelola-armada">
            <div class="head-title">
                <div class="left">
                    <h1>Kelola Armada</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Kelola Armada</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                    </ul>
                </div>
            </div>
            <div class="table-data">
                <div class="jadwal">
                    <div class="head">
                        <h3>Tambah Jadwal</h3>
                    </div>
                    <div class="form-jadwal">
                        <form action="" method="POST">
                            <div class="header">
                                <h3 class="heading"></h3>
                            </div>
                            <label for="PlatMobil">Plat Bus</label>
                            <br>
                            <input style="width: 1000px;" name="platBus" type="text" id="PlatMobil" list="koridor_bus" autocomplete="off" placeholder="Masukan Plat Bus">
                            <br>
                            <label for="from">Awal Halte</label>
                            <br>
                            <input style="width: 1000px;" name="awalHalte" type="text" id="from" list="asal_halte" autocomplete="off" placeholder="Asal Halte">
                           
                            <br>
                            <label for="to">Tujuan Akhir</label>
                            <br>
                            <input style="width: 1000px;" name="tujuanAkhir" type="text" id="to" list="tujuan_halte" autocomplete="off" placeholder="Tujuan Halte">
                        
                            <br>
                            <label for="koridor">Koridor Bus</label>
                            <br>
                            <input style="width: 1000px;" name="koridorBus" type="text" id="koridor" list="koridor_bus" autocomplete="off" placeholder="Koridor Bus">
                            <datalist id="koridor_bus">
                                <option value="K6">Koridor 6</option>
                                <option value="K5">Koridor 5</option>
                                <option value="K4">Koridor 4</option>
                                <option value="K3">Koridor 3</option>
                                <option value="K2">Koridor 2</option>
                                <option value="K1">Koridor 1</option>
                            </datalist>
                            <br>
                            <label for="jam">Jam Operasi</label>
                            <br>
                            <input style="width: 500px;" name="jamAwal" type="time" id="jam" value="jam_operasi">
                            <input style="width: 500px;" name="jamAkhir" type="time" id="jam_berakhir" value="jam_berakhir">
                            <br>
                            <div class="tombol-submit">
                                <input style="background-color: aqua; width: 200px; padding: 10px;" name="armada" type="submit" value="Simpan" id="SIMPAN">
                            </div>
                            <br>
                            <div class="tombol-delete">
                                <input style="background-color: rgb(255, 0, 0); width: 200px; padding: 10px;" type="reset" value="Hapus" id="Hapus">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="js/script_armada.js"></script>
</body>

</html>