<?php
// memanggil config
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: loginpetugas.php");
    exit();
}
// mengambil id tanggapan yang ingin dihapus
if (isset($_GET['id_tanggapan'])) {
    // menghapus data tanggapan
    $id_tanggapan = $_GET['id_tanggapan'];
    $query = "DELETE FROM tanggapan WHERE id_tanggapan=$id_tanggapan";
    $result = mysqli_query($koneksi, $query);
}
// mengembalikan ke daftar tanggapan
header("Location: tabletanggapan.php");
exit();

// menutup koneksi ke database
mysqli_close($koneksi);
