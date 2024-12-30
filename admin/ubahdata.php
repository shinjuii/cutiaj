<?php
session_start();
include "../koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Cek apakah ada ID pengguna yang ingin diedit
if (isset($_GET['id_user'])) {
    $id_user = input($_GET['id_user']);

    // Ambil data pengguna dari database
    $query = "SELECT * FROM user WHERE id_user='$id_user'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);

    // Cek apakah data ditemukan
    if (!$user) {
        echo "<div class='alert alert-danger'>Pengguna tidak ditemukan.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID pengguna tidak diberikan.</div>";
    exit;
}

// Proses pembaruan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = input($_POST["nama"]);
    $usn = input($_POST["username"]);
    $psw = input($_POST["psw"]);
    $alamat = input($_POST["alamat"]);
    $no_telp = input($_POST["no_telp"]);
    $role = input($_POST["role"]);
    $dpt = input($_POST["departemen"]);

    // Query untuk memperbarui data pengguna
    $sql = "UPDATE user SET nama='$nama', username='$usn', password='$psw', alamat='$alamat', no_telp='$no_telp', role='$role', kode_departemen='$dpt' WHERE id_user='$id_user'";

    // Eksekusi query
    $hasil = mysqli_query($koneksi, $sql);

    // Kondisi apakah berhasil atau tidak
    if ($hasil) {
        header("Location:index.php");
    } else {
        echo "<div class='alert alert-danger'> Data Gagal diperbarui.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<div class="container container-fluid">
    <div class="card">
        <div class="card-header">Formulir Edit Data Pengguna</div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="id_user">ID Pegawai : </label>
                    <input type="text" class="form-control" name="id_user" id="id_user" value="<?php echo $user['id_user']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Pegawai : </label>
                    <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $user['nama']; ?>">
                </div>
                <div class="form-group">
                    <label for="username">Username : </label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $user['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="psw">Password : </label>
                    <input type="password" class="form-control" name="psw" id="psw" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>
                <div class="form