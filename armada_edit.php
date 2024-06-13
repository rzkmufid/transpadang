<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
$kode_bus = $_GET["kode_bus"];
$result = mysqli_query($conn, "SELECT * FROM tb_bus WHERE kode_bus='$kode_bus'");

if (isset($_POST["armada"])) {
    $plat_bus = $_POST['platBus'];
    $awal_halte = $_POST['awalHalte'];
    $tujuan_akhir = $_POST['tujuanAkhir'];
    $koridor_bus = $_POST['koridorBus'];
    $jam_awal = $_POST['jamAwal'];
    $jam_akhir = $_POST['jamAkhir'];

    $q = "UPDATE tb_bus SET
 	plat_bus ='$plat_bus',
    awal_halte = '$awal_halte',
	tujuan_akhir = '$tujuan_akhir',
	koridor_bus = '$koridor_bus',
    jam_awal = '$jam_awal',
    jam_akhir = '$jam_akhir'

 	WHERE kode_bus = '$kode_bus'";
    mysqli_query($conn, $q);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>

		alert('Data telah berhasil diubah');
		document.location.href='bus.php';
		</script>";
    } else {
        echo "<script>

		alert('Data tidak bisa diubah');
		document.location.href='bus.php';
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
                        <h3>Edit Jadwal</h3>
                    </div>
                    <div class="form-jadwal">
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <form action="" method="POST">
                                <div class="header">
                                    <h3 class="heading"></h3>
                                </div>
                                <label for="PlatMobil">Plat Bus</label>
                                <br>
                                <input style="width: 1000px;" name="platBus" type="text" id="PlatMobil" list="koridor_bus" autocomplete="off" placeholder="Masukan Plat Bus" value="<?php echo $row['plat_bus']; ?>">
                                <br>
                                <label for="from">Awal Halte</label>
                                <br>
                                <input style="width: 1000px;" name="awalHalte" type="text" id="from" list="asal_halte" autocomplete="off" placeholder="Asal Halte" value="<?php echo $row['awal_halte']; ?>">
                                <datalist id="asal_halte">
                                    <option value="Pasaraya">Pasar Raya</option>
                                    <option value="Lubeg">Lubuk Begalung</option>
                                </datalist>
                                <br>
                                <label for="to">Tujuan Akhir</label>
                                <br>
                                <input style="width: 1000px;" name="tujuanAkhir" type="text" id="to" list="tujuan_halte" autocomplete="off" placeholder="Tujuan Halte" value="<?php echo $row['tujuan_akhir']; ?>">
                                <datalist id="tujuan_halte">
                                    <option value="Pasaraya">Pasar Raya</option>
                                    <option value="Lubeg">Lubuk Begalung</option>
                                </datalist>
                                <br>
                                <label for="koridor">Koridor Bus</label>
                                <br>
                                <input style="width: 1000px;" name="koridorBus" type="text" id="koridor" list="koridor_bus" autocomplete="off" placeholder="Koridor Bus" value="<?php echo $row['koridor_bus']; ?>">
                                <br>
                                <label for="jam">Jam Operasi</label>
                                <br>
                                <input style="width: 500px;" name="jamAwal" type="time" id="jam" value="<?php echo $row['jam_awal']; ?>">
                                <input style="width: 500px;" name="jamAkhir" type="time" id="jam_berakhir" value="<?php echo $row['jam_akhir']; ?>">
                                <br>
                                <div class="tombol-submit">
                                    <input style="background-color: aqua; width: 200px; padding: 10px;" name="armada" type="submit" value="Simpan" id="SIMPAN">
                                </div>
                                <br>
                                <div class="tombol-delete">
                                    <input style="background-color: rgb(255, 0, 0); width: 200px; padding: 10px;" type="reset" value="Hapus" id="Hapus">
                                </div>
                            </form>
                            <?php endwhile; ?>>
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