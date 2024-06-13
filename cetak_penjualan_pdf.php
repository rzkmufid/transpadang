<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
$result = mysqli_query($conn, "SELECT * FROM tb_pemesanan");

// Mendefinisikan style CSS untuk tabel
$style = '
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>';

// Memulai output HTML
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Penjualan</title>
    ' . $style . '
</head>
<body>
    <h1>Data Penjualan</h1>
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
        <tbody>';
$total_keseluruhan = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '
            <tr>
                <td>' . $row["id_pemesanan"] . '</td>
                <td>' . $row["kode_bus"] . '</td>
                <td>' . $row["koridor_bus"] . '</td>
                <td>' . $row["awal_halte"] . '</td>
                <td>' . $row["tujuan_akhir"] . '</td>
                <td>' . $row["jumlah_penumpang"] . '</td>
                <td>' . $row["status"] . '</td>
                <td>Rp. ' . $row["total_pembayaran"] . '</td>
            </tr>';
    $total_keseluruhan += $row["total_pembayaran"];
}


$html .= '
            <tr>
                <td colspan="7"><strong>Total Keseluruhan</strong></td>
                <td><strong>Rp. ' . $total_keseluruhan . '</strong></td>
            </tr>
        </tbody>
    </table>
    
    <script>
        // Fungsi untuk mencetak halaman saat ini
        function printPage() {
            window.print();
        }
        
        // Otomatis jalankan fungsi print saat halaman dimuat
        window.onload = function() {
            printPage();
        };
    </script>
</body>
</html>';

// Keluarkan HTML ke browser
echo $html;
