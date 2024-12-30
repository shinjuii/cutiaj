<?php
session_start();
include "../koneksi.php";

// Definisikan fungsi input
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // Fetch the existing data
    $query = "SELECT * FROM user WHERE id_user='$id_user'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = input($_POST["nama"]);
    $usn = input($_POST["username"]);
    $psw = input($_POST["psw"]);
    $alamat = input($_POST["alamat"]);
    $no_telp = input($_POST["no_telp"]);
    $role = input($_POST["role"]);
    $dpt = input($_POST["departemen"]);

    // Update query
    $sql = "UPDATE user SET nama='$nama', username='$usn', password='$psw', alamat='$alamat', no_telp='$no_telp', role='$role', kode_departemen='$dpt' WHERE id_user='$id_user'";

    if (mysqli_query($koneksi, $sql)) {
        header("Location:index.php");
        exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
    } else {
        echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>

<div class="container container-fluid">
    <div class="card">
        <div class="card-header">Ubah Data Pengguna</div>

        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="id_user">ID Pegawai </label>
                    <input type="text" class="form-control" name="id_user" id="id_user" value="<?php echo $user['id_user']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Pegawai  </label>
                    <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $user['nama']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="username">Username  </label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $user['username']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Password  </label>
                    <input type="text" class="form-control" name="psw" id="psw" value="<?php echo $user['password']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat  </label>
                    <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $user['alamat']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="no_telp">No Telp </label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" value="<?php echo $user['no_telp']; ?>" required>
                </div>

                <label for="role">Role </label>
                <select name="role" id="role" class="form-control" required>
                    <option value="">Pilih Role</option>
                    <option value="Pegawai" <?php if($user['role'] == 'Pegawai') echo 'selected'; ?>>Pegawai</option>
                    <option value="Kepala" <?php if($user['role'] == 'Kepala') echo 'selected'; ?>>Kepala Unit Kerja</option>
                </select>

                <label for="departemen">Role </label>
                <select id="role" class="form-control" name="role" required>
                    <option value="">Pilih role</option>
                    <option value="pegawai" <?php if($user['role'] == 'pegawai') echo 'selected'; ?>>Pegawai</option>
                    <option value="kepala" <?php if($user['role'] == 'kepala') echo 'selected'; ?>>Kepala Unit Kerja</option>
                </select>

                <label for="departemen">Departemen </label>
                <select id="departemen" class="form-control" name="departemen" required>
                    <option value="">Pilih Departemen</option>
                    <option value="RKS" <?php if($user['kode_departemen'] == 'RKS') echo 'selected'; ?>>RKS</option>
                    <option value="TRM" <?php if($user['kode_departemen'] == 'TRM') echo 'selected'; ?>>TRM</option>
                    <option value="TRPL" <?php if($user['kode_departemen'] == 'TRPL') echo 'selected'; ?>>TRPL</option>
                    <option value="IF" <?php if($user['kode_departemen'] == 'IF') echo 'selected'; ?>>IF</option>
                    <option value="GM" <?php if($user['kode_departemen'] == 'GM') echo 'selected'; ?>>GM</option>
                    <option value="GIM" <?php if($user['kode_departemen'] == 'GIM') echo 'selected'; ?>>GIM</option>
                    <option value="AN" <?php if($user['kode_departemen'] == 'AN') echo 'selected'; ?>>AN</option>
                </select>

                <div class="form-group mt-2">
                    <button class="btn btn-primary" type="submit" name="submit">Ubah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>

