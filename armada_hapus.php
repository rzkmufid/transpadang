<?php
require 'koneksi.php';

$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
$kode_bus = $_GET["kode_bus"];

mysqli_query($conn, "DELETE FROM tb_bus WHERE kode_bus='$kode_bus'");

if (mysqli_affected_rows($conn) > 0) {
    echo "<script>
        
            alert('Data berhasil dihapus');
            document.location.href='bus.php';
            </script>";
} else {
    echo "<script>
    
             alert('Data gagal dihapus, Codingannya ada yang salah coyy!');
             document.location.href='bus.php';
             </script>";
}

?>