<?php
session_start();

//Include file koneksi, untuk koneksikan ke database
include "../koneksi.php";

//Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Periksa apakah session nama sudah ada atau berasal dari input POST
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
} else {
    $id_user = isset($_POST['id_user']) ? input($_POST['id_user']) : '';
}
if (isset($_SESSION['nama'])) {
    $nama = $_SESSION['nama'];
} else {
    $nama = isset($_POST['nama']) ? input($_POST['nama']) : '';
}

if (isset($_SESSION['username'])) {
    $usn = $_SESSION['username'];
} else {
    $usn = isset($_POST['username']) ? input($_POST['username']) : '';
}
if (isset($_SESSION['alamat'])) {
    $alamat = $_SESSION['alamat'];
} else {
    $alamat = isset($_POST['alamat']) ? input($_POST['alamat']) : '';
}
if (isset($_SESSION['no_telp'])) {
    $no_telp = $_SESSION['no_telp'];
} else {
    $no_telp = isset($_POST['no_telp']) ? input($_POST['no_telp']) : '';
}
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    $role = isset($_POST['role']) ? input($_POST['role']) : '';
}
if (isset($_SESSION['departemen'])) {
    $kode_departemen = $_SESSION['departemen'];
} else {
    $kode_departemen = isset($_POST['departemen']) ? input($_POST['departemen']) : '';
}



// Cek apakah ada kiriman form dari method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = input($_POST["id_user"]);
    $nama = input($_POST["nama"]);
    $usn = input($_POST["username"]);
    $psw = input($_POST["psw"]);
    $alamat = input($_POST["alamat"]);
    $no_telp = input($_POST["no_telp"]);
    $role = input($_POST["role"]);
    $dpt = input($_POST["departemen"]);

    // Query input untuk menginput data ke tabel peserta
    $sql = "INSERT INTO user (id_user, nama, username, password, alamat, no_telp, role, kode_departemen) 
            VALUES ('$id','$nama','$usn','$psw','$alamat','$no_telp','$role','$dpt')";

    // Eksekusi query
    $hasil = mysqli_query($koneksi, $sql);

    // Kondisi apakah berhasil atau tidak
    if ($hasil) {
        header("Location:index.php");
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
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
        <div class="card-header">Tambah Data Pengguna</div>

        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                </div>

                <div class="form-group">
                    <label for="id_user">ID user : </label>
                    <input type="text" class="form-control" name="id_user" id="id_user" >
                </div>

                <div class="form-group">
                    <label for="nama">Nama user : </label>
                    <input type="text" class="form-control" name="nama" id="nama">
                </div>
                
                <div class="form-group">
                    <label for="nama">Username : </label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>

                <div class="form-group">
                    <label for="nama">Password : </label>
                    <input type="text" class="form-control" name="psw" id="psw">
                </div>

                
                <div class="form-group">
                    <label for="alamat">alamat : </label>
                    <input type="text" class="form-control" name="alamat" id="alamat">
                </div>
                
                <div class="form-group">
                    <label for="no_telp">No Telp :</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp">
                </div>
                <label for="role">Role :</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="Pegawai">Pegawai</option>
                        <option value="Kepala">Kepala Unit Kerja</option>
                    </select>



                <label for="departemen">Departemen :</label>
                    <select id="departemen" class="form-control" name="departemen" required>
                        <option value="">Pilih Departemen</option>
                        <option value="RKS">RKS</option>
                        <option value="TRM">TRM</option>
                        <option value="TRPL">TRPL</option>
                        <option value="IF">IF</option>
                        <option value="GM">GM</option>
                        <option value="GIM">GIM</option>
                        <option value="AN">AN</option>
                    </select>
                

                <div class="form-group mt-2">
                    <button class="btn btn-primary" type="submit" name="submit" onclick="alert()">Tambah Data</button>
                </div>
                <script>
                    function alert() {
                        swal({
                            title:"Data Berhasil Ditambahkan",
                            text: "Data Pengguna berhasil",
                            icon: "success",
                            button: "Sukses"
                        });
                    }

                </script>
            </form>
            </form>

        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>

