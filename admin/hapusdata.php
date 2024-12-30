<?php
session_start();
include "../koneksi.php";

// Cek apakah ada ID pengguna yang ingin dihapus
if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // Query untuk menghapus data pengguna
    $sql = "DELETE FROM user WHERE id_user='$id_user'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php"); // Redirect ke halaman daftar pengguna
    } else {
        echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
    }
} else {
    echo "<div class='alert alert-danger'> ID pengguna tidak diberikan.</div>";
}
?>