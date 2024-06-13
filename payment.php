<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Buat koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
$koridor_bus = $_POST['koridorBus'];
$awalHalte = $_POST['awalHalte'];
$tujuanAkhir = $_POST['tujuanAkhir'];
$jumlahPenumpang = $_POST['jumlahPenumpang'];
$status = $_POST['status'];
$kodeBus = $_POST['kodeBus'];

// Hitung total bayar
$total_bayar = $jumlahPenumpang * 5000;
// Proses form saat tombol "pay" ditekan
if (isset($_POST['pay'])) {
    // Tangkap data dari form
    $koridor_bus = $_POST['koridorBus'];
    $awalHalte = $_POST['awalHalte'];
    $tujuanAkhir = $_POST['tujuanAkhir'];
    $jumlahPenumpang = $_POST['jumlahPenumpang'];
    $status = $_POST['status'];
    $kodeBus = $_POST['kodeBus'];

    // Hitung total bayar
    $total_bayar = $jumlahPenumpang * 5000;

    // Query untuk menyimpan data pemesanan ke database
    $q = "INSERT INTO tb_pemesanan (kode_bus, koridor_bus, awal_halte, tujuan_akhir, jumlah_penumpang, status, total_pembayaran, bukti_pembayaran)
          VALUES ('$kodeBus', '$koridor_bus', '$awalHalte', '$tujuanAkhir', '$jumlahPenumpang', '$status', '$total_bayar', 'Pembayaran Berhasil')";

    // Eksekusi query
    $result = mysqli_query($conn, $q);

    // Cek apakah query berhasil dijalankan
    if ($result) {
        // Redirect ke halaman beranda_user.php setelah pembayaran berhasil
        header('Location: beranda_user.php');
        exit;
    } else {
        echo "Error: " . $q . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/payment/tailwindcss-colors.css">
    <link rel="stylesheet" href="css/payment/style-payment.css">
    <title>Payment Page</title>
</head>

<body>
    <!-- start: Payment -->
    <section class="payment-section">
        <div class="container">
            <div class="payment-wrapper">
                <div class="payment-left">
                    <div class="payment-header">
                        <div class="payment-header-icon"><i class="ri-flashlight-fill"></i></div>
                        <div class="payment-header-title">Pembayaran</div>
                        <p class="payment-header-description"></p>
                    </div>
                    <div class="payment-content">
                        <div class="payment-body">
                            <div class="payment-plan">
                                <div class="payment-plan-type">TP</div>
                                <div class="payment-plan-info">
                                    <div class="payment-plan-info-name">TransPadang</div>
                                </div>
                                <!-- <a href="#" class="payment-plan-change">Change</a> -->
                            </div>
                            <div class="payment-summary">
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">Koridor Bus</div>
                                    <div class="payment-summary-price">Koridor <?= $koridor_bus ?></div>
                                </div>
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">From</div>
                                    <div class="payment-summary-price"><?= $awalHalte; ?></div>
                                </div>
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">To</div>
                                    <div class="payment-summary-price"><?= $tujuanAkhir; ?></div>
                                </div>
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">Jumlah Penumpang</div>
                                    <div class="payment-summary-price"><?= $jumlahPenumpang; ?></div>
                                </div>
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">Status</div>
                                    <div class="payment-summary-price"><?= $status; ?></div>
                                </div>
                                <div class="payment-summary-divider"></div>
                                <div class="payment-summary-item payment-summary-total">
                                    <div class="payment-summary-name">Total</div>
                                    <div class="payment-summary-price">Rp.<?= $total_bayar; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-right">
                    <form id="paymentForm" action="" method="POST" class="payment-form">
                        <h1 class="payment-title">Pilih Pembayaran</h1>
                        <div class="payment-method">
                            <input type="radio" name="payment-method" id="method-1" checked>
                            <label for="method-1" class="payment-method-item">
                                <img src="assets/payment/943c971903518e53ffd324dd51e46a90.jpg" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-2">
                            <label for="method-2" class="payment-method-item">
                                <img src="assets/payment/f58ca3528b238877e9855fcac1daa328.jpg" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-3">
                            <label for="method-3" class="payment-method-item">
                                <img src="assets/payment/27718b01-design-sem-nome-442x332.png" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-4">
                            <label for="method-4" class="payment-method-item">
                                <img src="assets/payment/LinkAja.svg.png" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-5">
                            <label for="method-5" class="payment-method-item">
                                <img src="assets/payment/pngwing.com (18).png" alt="">
                            </label>

                        </div>
                        <!-- Masukkan input tersembunyi untuk mengirim data yang diperlukan -->
                        <input type="hidden" name="koridorBus" value="<?= $koridor_bus ?>">
                        <input type="hidden" name="awalHalte" value="<?= $awalHalte ?>">
                        <input type="hidden" name="tujuanAkhir" value="<?= $tujuanAkhir ?>">
                        <input type="hidden" name="jumlahPenumpang" value="<?= $jumlahPenumpang ?>">
                        <input type="hidden" name="status" value="<?= $status ?>">
                        <input type="hidden" name="kodeBus" value="<?= $kodeBus ?>">
                        <button type="submit" class="payment-form-submit-button" name="pay">
                            <i class="ri-wallet-line"></i> Pay
                        </button>
                    </form>
                    <!-- <script>
                        document.getElementById('paymentForm').addEventListener('submit', function(event) {
                            event.preventDefault();
                            alert('Pembayaran Berhasil!');
                            this.submit();
                        });
                    </script> -->
                </div>
            </div>
        </div>
    </section>
    <!-- end: Payment -->
</body>

</html>