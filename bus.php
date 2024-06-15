<?php

                            session_start();

                            // Periksa apakah pengguna belum login
                            if (!isset($_SESSION['username'])) {
                                // Redirect ke halaman login atau tindakan lain yang sesuai
                                header("Location: index.php");
                                exit();
                            }

$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
$result = mysqli_query($conn, "SELECT * FROM tb_bus");

if (isset($_POST["cari"])) {
	$cari = $_POST["keyword"];
	$q = "SELECT * FROM tb_bus WHERE 
	koridor_bus LIKE '%$cari%'OR
	awal_halte LIKE '%$cari%' 
	
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
            <li class="active">
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
            <li>
                <a href="kelola_armada.php">
                    <i class='bx bxs-bus'></i>
                    <span class="text">Kelola Armada</span>
                </a>
            </li>
            <li class="active">
                <a href="#">
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
            <a href="#" class="nav-link">Bus</a>
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
                    <h1>Data Bus</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Data Bus</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Download PDF</span>
                </a>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Daftar Koridor Bus</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Kode Bus</th>
                                <th>Plat Bus</th>
                                <th>Awal Halte</th>
                                <th>Tujuan Akhir Halte</th>
                                <th>Koridor Bus</th>
                                <th>Jam Operasi</th>
                                <th>CRUD</th>
                            </tr>

                            <?php $i = 1;
							while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td>
                                    <?= $row["kode_bus"]; ?>
                                </td>
                                <td>
                                    <?= $row["plat_bus"]; ?>
                                </td>
                                <td>
                                    <?= $row["awal_halte"]; ?>
                                </td>
                                <td>
                                    <?= $row["tujuan_akhir"]; ?>
                                </td>
                                <td>
                                    <?= $row["koridor_bus"]; ?>
                                </td>
                                <td>
                                    <?= $row["jam_awal"]; ?> - <?= $row["jam_akhir"]; ?>
                                </td>
                                <td id="left-bottom"><a
                                        href="armada_edit.php?kode_bus=<?php echo $row["kode_bus"]; ?>">Edit</a> | <a
                                        href="armada_hapus.php?kode_bus=<?php echo $row["kode_bus"]; ?>">Hapus</a></td>
                            </tr>

                            <?php $i++;
							endwhile; ?>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="assets/admin/pngwing.com (15).png" alt="Bus Image">
                                    <p></p>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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