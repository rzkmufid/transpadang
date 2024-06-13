<?php

session_start();

// Periksa apakah pengguna belum login
if (!isset($_SESSION['username'])) {
	// Redirect ke halaman login atau tindakan lain yang sesuai
	header("Location: index.php");
	exit();
}
// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');

// Periksa koneksi
if (!$conn) {
	die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data halte awal dan tujuan dari database
$halte_query = mysqli_query($conn, "SELECT DISTINCT awal_halte, tujuan_akhir FROM tb_bus");
$halte_options = [];
while ($row = mysqli_fetch_assoc($halte_query)) {
	$halte_options[] = $row['awal_halte'];
	$halte_options[] = $row['tujuan_akhir'];
}
// Buang nilai yang duplikat dan urutkan
$halte_options = array_unique($halte_options);
sort($halte_options);



// Ambil data pengguna yang sedang login
$user_id = 'some_user_id'; // Ganti dengan ID pengguna yang sesuai
$user_query = mysqli_query($conn, "SELECT * FROM tb_login WHERE id_member = '$user_id'");
$user = mysqli_fetch_assoc($user_query);

// Ambil data bus untuk dropdown
$bus_query = mysqli_query($conn, "SELECT koridor_bus, kode_bus FROM tb_bus");
$bus_routes = [];
while ($row = mysqli_fetch_assoc($bus_query)) {
	$koridor = $row['koridor_bus'];
	$kode = $row['kode_bus'];
	if (!isset($bus_routes[$koridor])) {
		$bus_routes[$koridor] = [];
	}
	$bus_routes[$koridor][] = $kode;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user/style-berandaUser2.css">
    <title>TransPadang</title>
    <style>
    /* Tambahkan CSS di sini untuk memperbaiki tampilan */
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h3 {
        text-align: center;
        color: #3d93ef;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group input[type="radio"] {
        width: auto;
    }

    .form-group .radio-label {
        display: inline-block;
        margin-right: 10px;
    }

    .form-group .tombol-submit,
    .form-group .tombol-delete {
        text-align: center;
    }

    .form-group .tombol-submit input,
    .form-group .tombol-delete input {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #3d93ef;
        color: white;
        cursor: pointer;
    }

    .form-group .tombol-delete input {
        background-color: #ff4b4b;
    }

    .form-group .tombol-submit input:hover,
    .form-group .tombol-delete input:hover {
        opacity: 0.9;
    }
    </style>
    <script>
    function changeBus() {
        var koridor = document.getElementById("koridorBus").value; // Mendapatkan koridor yang dipilih
        var buses = <?php echo json_encode($bus_routes); ?>; // Mendapatkan data rute bus dari PHP
        var busOptions = buses[koridor]; // Mendapatkan opsi bus untuk koridor yang dipilih
        var inputKodeBus = document.getElementById("kodeBus"); // Mendapatkan elemen input kodeBus

        // Cari apakah koridor dipilih valid
        if (busOptions && busOptions.length > 0) {
            // Jika ada opsi bus untuk koridor yang dipilih, gunakan kode bus pertama sebagai nilai default
            inputKodeBus.value = busOptions[0];
        } else {
            // Jika tidak ada opsi yang tersedia untuk koridor yang dipilih, kosongkan nilai input
            inputKodeBus.value = "";
        }
    }
    </script>
</head>



<body>

    <!-- NAVBAR -->
    <nav>
        <div class="container">
            <i><img src="assets/user/Blue_Yellow_Modern_Creative_Initial_Font_Logo-removebg-preview.png" align="left"
                    alt="" height=18% width=18%></i>
            <ul class="nav-menu">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#haltebus">Halte Bus</a></li>
                <li><a href="#services">Info Tiket</a></li>
                <li><a href="#blogs">Tentang</a></li>
                <li><a href="#contact">Contact</a></li>
                <?php if ($user) : ?>
                <li><a href="profile.php?id_member=<?php echo $user["id_member"]; ?>"><i
                            class='bx bxs-user-circle'></i></a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <i class='bx bx-menu toggle-menu'></i>
        </div>
    </nav>
    <!-- NAVBAR -->

    <!-- HEADER -->
    <header>
        <div class="container">
            <div class="form">
                <center>
                    <h3 align="center"
                        style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                        Selamat Datang di Website TransPadang
                    </h3>
                    <br>
                    <form action="payment.php" method="POST">
                        <!-- Place this code where you want the bus corridor select dropdown to appear -->
                        <div class="form-group" align='left'>
                            <label for="koridorBus">Koridor Bus</label>
                            <input type="text" id="koridorBus" name="koridorBus" list="listKoridor"
                                onchange="changeBus()" required />
                            <datalist id="listKoridor">
                                <?php foreach (array_keys($bus_routes) as $koridor) : ?>
                                <option value="<?php echo $koridor; ?>"><?php echo "Koridor $koridor"; ?></option>
                                <?php endforeach; ?>
                            </datalist>
                        </div>


                        <div class="form-group" align='left'>
                            <label for="kodeBus">Kode Bus</label>
                            <input type="text" id="kodeBus" name="kodeBus" list="listKodeBus" required />
                            <datalist id="listKodeBus">
                                <!-- Kode bus options will be filled automatically using JavaScript -->
                            </datalist>
                        </div>

                        <div class="form-group" align='left'>
                            <label for="from">From</label>
                            <input type="text" id="from" name="awalHalte" list="asal_halte" autocomplete="off"
                                placeholder="Asal Halte" required />
                            <datalist id="asal_halte">
                                <?php foreach ($halte_options as $halte) : ?>
                                <option value="<?php echo $halte; ?>">
                                    <?php endforeach; ?>
                            </datalist>
                        </div>

                        <div class="form-group" align='left'>
                            <label align='left' for="to">To</label>
                            <input type="text" id="to" list="tujuan_halte" name="tujuanAkhir" autocomplete="off"
                                placeholder="Tujuan Halte" required />
                            <datalist id="asal_halte">
                                <?php foreach ($halte_options as $halte) : ?>
                                <option value="<?php echo $halte; ?>">
                                    <?php endforeach; ?>
                            </datalist>

                            <datalist id="tujuan_halte">
                                <?php foreach ($halte_options as $halte) : ?>
                                <option value="<?php echo $halte; ?>">
                                    <?php endforeach; ?>
                            </datalist>

                        </div>

                        <div class="form-group" align='left'>
                            <label for="jumlah">Jumlah Penumpang</label>
                            <input type="number" name="jumlahPenumpang" id="jumlah" placeholder="Jumlah Penumpang"
                                required />
                        </div>

                        <div class="form-group">
                            <label align='left'>Status</label>
                            <label class="radio-label">
                                <input type="radio" name="status" id="umum" value="Umum" required> Umum
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="status" id="mahasiswa" value="Mahasiswa" required> Mahasiswa
                            </label>
                        </div>

                        <div class="form-group tombol-submit">
                            <input type="submit" name="pemesanan" value="Order" id="order" />
                        </div>
                        <div class="form-group tombol-delete">
                            <input type="reset" value="Hapus" id="Hapus" />
                        </div>
                    </form>
                </center>
            </div>
            <div class="img">
                <img src="assets/user/pngegg (3).png" alt="Image">
            </div>
        </div>
    </header>
    <!-- HEADER -->
    <section id="haltebus">
        <div class="container">
            <div class="img">
                <img src="assets/user/pngwing.com (16).png" alt="Image">
            </div>
            <div class="text">
                <h3>Rute Bus</h3>
                <p>Trans Padang memiliki 6 Bis rute di Padang dengan 155 Bis pemberhentian.
                    Bis rute mereka mencakup area dari Utara (Padang Sarai) dengan satu pemberhentian di Halte Mega
                    Permai 2 ke Selatan (Pampangan Nan XX) dengan satu pemberhentian di Halte Simpang Pampangan II.
                    Pemberhentian paling barat mereka adalah Halte Mega Permai 2 (Padang Sarai) dan pemberhentian paling
                    timur adalah Masjid Raya Al- Ittihad (Indarung).
                </p>
                <a href="#moredetail" class="btn-outline">More details</a>
            </div>
        </div>
        <br><br><br><br><br><br><br>
    </section>
    <section id="moredetail">
        <center>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Daftar Rute Bus</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Koridor Bus</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center">
                                    <img class="imgkoridor" src="assets/user/pngwing.com (15).png">
                                    <details>
                                        <summary>Rute Bus Koridor 1</summary>
                                        <img src="assets/user/Koridor 1.jpg" alt="" width="500">
                                    </details>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <img class="imgkoridor" src="assets/user/pngwing.com (15).png">
                                    <details>
                                        <summary>Rute Bus Koridor 2</summary>
                                        <img src="assets/user/koridor 2.jpg" alt="" width="500">
                                    </details>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <img class="imgkoridor" src="assets/user/pngwing.com (15).png">
                                    <details>
                                        <summary>Rute Bus Koridor 3</summary>
                                        <img src="assets/user/koridor 3.jpg" alt="">
                                    </details>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <img class="imgkoridor" src="assets/user/pngwing.com (15).png">
                                    <details>
                                        <summary>Rute Bus Koridor 4</summary>
                                        <img src="assets/user/koridor 4.jpg" alt="" width="500">
                                    </details>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <img class="imgkoridor" src="assets/user/pngwing.com (15).png">
                                    <details>
                                        <summary>Rute Bus Koridor 5</summary>
                                        <img src="assets/user/koridor 5.jpg" alt="" width="500">
                                    </details>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <img class="imgkoridor" src="assets/user/pngwing.com (15).png">
                                    <details>
                                        <summary>Rute Bus Koridor 6</summary>
                                        <img src="assets/user/koridor 6.jpg" alt="" width="500">
                                    </details>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </center>
    </section>
    <!-- ABOUT -->
    <!--More Detail-->

    <br><br><br><br><br><br><br>
    <!-- info tiket -->
    <section id="services">
        <div class="container">
            <div class="title">
                <h3>Info Tiket</h3>
            </div>
            <div class="content">
                <ul class="service-list">
                    <li>
                        <i class='bx bxs-shield'></i>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id saepe similique optio quam eum
                            atque repellat ex quaerat suscipit rerum.</p>
                    </li>
                    <li>
                        <i class='bx bxs-ambulance'></i>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id saepe similique optio quam eum
                            atque repellat ex quaerat suscipit rerum.</p>
                    </li>
                    <li>
                        <i class='bx bx-health'></i>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id saepe similique optio quam eum
                            atque repellat ex quaerat suscipit rerum.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- info tiket -->

    <!-- BLOGS -->
    <section id="blogs">
        <div class="container">
            <div class="title">
                <h3>Tentang</h3>
            </div>
            <div class=malasngoding-slider>
                <div class=isi-slider>
                    <img src="assets/user/IMG_4411.JPG" alt="Gambar 1">
                    <img src="assets/user/IMG_4412.JPG" alt="Gambar 2">
                    <img src="assets/user/IMG_4413.JPG" alt="Gambar 3">
                </div>
            </div>
            <div class="table-informasi">
                <table style="background-color: white;">
                    <tr>
                        <td>
                            <h1>Trans Padang</h1>
                            <p>Dishub serta pemerintahan kota padang menghadirkan transportasi konvensional modern yaitu
                                Trans padang yang resmi dioperasikan tahun 2014. Trans padang ialah suatu akomodasi
                                angkutan umum di kota padang berbasis bus rapid transit (BRT) yang beroperasi pada
                                januari 2014. Trans Padang hingga saat ini terus melayani perkembangan setiap tahunnya
                                baik itu dari jumlah unit pengoperasian maupun pelayanan.
                                Kehadiran Trans Padang berdampak baik terhadap tata keloka kota yang lebih terarah dan
                                teratur karena transportasi lainnya yang dilengkapi fasilitas serta sarana dan prasarana
                                yang lebih baik lagi seperti memiliki halte, rute keberangkatannya dibagi per Koridor,
                                dilebgkapi dengan kapasitas tempat duduk sebanyak 40 kursi dan kapasitas berdiri 20,
                                selain itu juga dilengkapi dengan pendingin ruangan (AC) dan keamanannya juga terjaga.
                                Trans Padang merupakan layanan angkutan masal Bus Rapid Transit (BRT) di Kota Padang
                                yang mulai beroperasi pada Januari 2014. Koridor yang telah beroperasi adalah pada rute
                                Lubuk Buaya-Pasar Raya. Bus Trans Padang memiliki kapasitas penumpang sebanyak 40 orang,
                                yang terdiri dari 20 orang penumpang dengan fasilitas tempat duduk, dan 20 orang
                                penumpang berdiri dengan fasilitas pegangan tangan. Bus Trans Padang dilengkapi
                                fasilitas tempat duduk prioritas untuk para penumpang lanjut usia, ibu hamil, penumpang
                                dengan membawa anak serta penumpang dengan kebutuhan khusus. </p>
                        </td>
                    </tr>
                    <br>
                </table>
                <table border="1" style="background-color: rgb(255, 255, 255);">
                    <tr>
                        <td>
                            <h1>Visi Misi Trans Padang</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2>Visi Perumda Sejahtera Mandiri Padang Divisi Transpadang</h2>
                            <p>Terwujudnya Sumatera Barat Mandani yang Unggul dan Berkelanjutan</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2>Misi Perumda Sejahtera Mandiri Padang Divisi Transpadang</h2>
                            <ol>
                                <li>1.Meningkatkan kualitas sumber daya manusia yang sehat, berpengetahuan, terampil dan
                                    berdaya saing.</li>
                                <li>2.Meningkatkan tata kehidupan social kemasyarakatan berdasarkan Filsafah Adaik
                                    Basandi Syara, Syara Basandi Kitabullah.</li>
                                <li>3.Meningkatkan nilai tambah dan produktifitas dan perikanan.</li>
                                <li>4.Meningkatkan ekonomi kreatif dan daya saing kepariwisataan.</li>
                                <li>5.Meningkatkan pembangunan infrastruktur yang berkeadilan dan berkelanjutan.</li>
                                <li>6.Mewujudkan tata kelola pemerintah dan pelayanan public yang bersih, akuntabel
                                    serta berkualitas.</li>
                            </ol>
                        </td>
                    </tr>
                    <br>


                </table>
            </div>
    </section>
    <!-- BLOGS -->

    <!-- CONTACT -->
    <section id="contact">
        <div class="container">
            <div class="title">
                <h3>Contact us</h3>
            </div>
            <div class="content">

                <div class="address">
                    <h5>Address info</h5>
                    <ul>
                        <li><i class='bx bxs-map'></i> Indonesia,Provinsi Sumatra Barat,Kota Padang</li>
                        <li><i class='bx bxs-envelope'></i> pamperumda@email.com</li>
                        <li><i class='bx bxs-phone'></i> +628xxxxxxxx</li>
                        <li><i class='bx bxl-instagram'></i>@official_transpadang.psm</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT -->

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="top">
                <div>
                    <a href="#" class="brand">Trans Padang</a>

                </div>
                <div class="navigation">
                    <h5>Navigation</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#blogs">Blogs</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="social">
                    <h5>Social</h5>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="container">
                <ul class="links">
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- FOOTER -->

    <script src="js/script-berandaUser.js"></script>
</body>

</html>
<!-- Other sections... -->

<script src="js/script-berandaUser.js"></script>


</body>

</html>