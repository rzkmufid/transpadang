<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
$result = mysqli_query($conn, "SELECT * FROM tb_bus");

if (isset($_POST["cari"])) {
	$cari = $_POST["keyword"];
	$q = "SELECT * FROM tb_bus WHERE koridor_bus LIKE '%$cari%'";

	$result = mysqli_query($conn, $q);
}


// Kueri untuk mengambil data member
$member_query = mysqli_query($conn, "SELECT COUNT(id_member) as total_member FROM tb_login");
$total_member = mysqli_fetch_assoc($member_query)['total_member'];

// Kueri untuk mengambil data penjualan
$penjualan_query = mysqli_query($conn, "SELECT SUM(total_pembayaran) as total_pembayaran FROM tb_pemesanan");
$total_penjualan = mysqli_fetch_assoc($penjualan_query)['total_pembayaran'];
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
                <a href="#">
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
            <a href="#" class="nav-link">Koridor</a>
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
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <a href="member.php"><i class='bx bxs-group'></i></a>
                    <span class="text">
                        <h3><?php echo $total_member; ?></h3>
                        <p>Member</p>
                    </span>
                </li>
                <li>
                    <a href="penjualan.php"><i class='bx bxs-dollar-circle'></i></a>
                    <span class="text">
                        <h3><?php echo "Rp. " . number_format($total_penjualan, 2); ?></h3>
                        <p>Total Penjualan</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Daftar Koridor Bus</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Kode Bus</th>
                                <th>Plat Mobil</th>
                                <th>Awal Halte</th>
                                <th>Tujuan Akhir Halte</th>
                                <th>Koridor Bus</th>
                                <th>Jam Operasonal</th>
                            </tr>

                            <?php $i = 1;
							while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td>
                                    <?= $row["plat_bus"]; ?>
                                </td>
                                <td>
                                    <?= $row["kode_bus"]; ?>
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

    <!-- KELOLA ARMADA -->
    <!-- <section id="kelola_armada">
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
					<form>
						<div class="header">
							<h3 class="heading"></h3>
						</div>
						<label for="PlatMobil">Plat Bus</label>
						<br>
						<input type="text" id="PlatMobil" list="koridor_bus" autocomplete="off" placeholder="Masukan Plat Bus" style="width: 1000px;">
						<br>
						<label for="kdbus">Kode Bus</label>
						<br>
						<input type="text" id="kdbus" list="koridor_bus" autocomplete="off" placeholder="Masukan Kode Bus" style="width: 1000px;">
						<br>
						<label for="from">Awal Halte</label>
						<br>
						<input type="text" id="from" list="asal_halte" autocomplete="off" placeholder="Asal Halte" style="width: 1000px;">
						<datalist id="asal_halte">
							<option value="Pasaraya">Pasar Raya</option>
							<option value="Lubeg">Lubuk Begalung</option>
						</datalist>
						<br>
						<label for="to">Tujuan Akhir</label>
						<br>
						<input type="text" id="to" list="tujuan_halte" autocomplete="off" placeholder="Tujuan Halte" style="width: 1000px;">
						<datalist id="tujuan_halte">
							<option value="Pasaraya">Pasar Raya</option>
							<option value="Lubeg">Lubuk Begalung</option>
						</datalist>
						<br>
						<label for="koridor">Koridor Bus</label>
						<br>
						<input type="text" id="koridor" list="koridor_bus" autocomplete="off" placeholder="Koridor Bus" style="width: 1000px;">
						<br>
						<label for="jam">Jam Operasi</label>
						<br>
						<input type="time" id="jam" value="jam_operasi" style="width: 500px;">
						<input type="time" id="jam_berakhir" value="jam_berakhir" style="width: 500px;">
						<br>
						<div class="tombol-submit">
							<input type="submit" value="Simpan" id="SIMPAN" style="background-color: aqua; width: 200px; padding: 10px;">
						</div>
						<br>
						<div class="tombol-delete">
							<input type="reset" value="Hapus" id="Hapus" style="background-color: rgb(255, 0, 0); width: 200px; padding: 10px;">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section> -->
    <!-- KELOLA ARMADA -->

    <script src="js/script-admin.js"></script>
</body>

</html>