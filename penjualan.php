<?php

                                        session_start();

                                        // Periksa apakah pengguna belum login
                                        if (!isset($_SESSION['username'])) {
                                            // Redirect ke halaman login atau tindakan lain yang sesuai
                                            header("Location: index.php");
                                            exit();
                                        }

$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
$result = mysqli_query($conn, "SELECT * FROM tb_pemesanan");

if (isset($_POST["cari"])) {
    $cari = $_POST["keyword"];
    $q = "SELECT * FROM tb_pemesanan WHERE 
	id_pemesanan LIKE '%$cari%'OR
	nama_member LIKE '%$cari%' 
	
	";

    $result = mysqli_query($conn, $q);
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
            <li class="active">
                <a href="#">
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
            <li>
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
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Penjualan</a>
            <form action="#" method="POST">
                <div class="form-input">
                    <input type="search" name="keyword" placeholder="Search...">
                    <button type="submit" class="search-btn" name="cari"><i class='bx bx-search'></i></button>
                </div>
            </form>
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
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Data Penjualan</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Data Penjualan</a>
                        </li>
                    </ul>
                </div>
                <a href="cetak_penjualan_pdf.php" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Download PDF</span>
                </a>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Daftar Penjualan</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pemesanan</th>
                                <th>Kode Bus</th>
                                <th>Koridor Bus</th>
                                <th>Awal Halte</th>
                                <th>Tujuan Akhir Halte</th>
                                <th>Jumlah Penumpang</th>
                                <th>Status</th>
                                <th>Total Pembayaran</th>
                            </tr>


                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $total_keseluruhan = 0;
                            while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td>P
                                        <?= $row["id_pemesanan"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["kode_bus"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["koridor_bus"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["awal_halte"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["tujuan_akhir"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["jumlah_penumpang"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["status"]; ?>
                                    </td>
                                    <td>Rp.
                                        <?= $row["total_pembayaran"]; ?>
                                    </td>
                                </tr>

                            <?php $i++;
                                $total_keseluruhan += $row["total_pembayaran"];
                            endwhile; ?>
                            <tr>
                                <td>Total Keseluruhan</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Rp. <?= $total_keseluruhan ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="js/script-admin.js"></script>
</body>

</html>