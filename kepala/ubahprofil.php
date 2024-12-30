<?php
session_start();

// Include file koneksi
include "../koneksi.php";

// Fungsi untuk mencegah input karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user dari session
$id_user = $_SESSION['id_user'];

// Ambil data user dari database
$sql = "SELECT * FROM user WHERE id_user = '$id_user'";
$result = $koneksi->query($sql);
$user = $result->fetch_assoc();

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alamat_baru = input($_POST['alamat']);
    $no_telp_baru = input($_POST['no_telp']);

    // Update data di database
    $sql_update = "UPDATE user SET alamat = '$alamat_baru', no_telp = '$no_telp_baru' WHERE id_user = '$id_user'";
    if ($koneksi->query($sql_update) === TRUE) {
        $_SESSION['alamat'] = $alamat_baru; // Perbarui session
        $_SESSION['no_telp'] = $no_telp_baru; // Perbarui session
        header("Location: profil.php"); // Kembali ke halaman profil
        exit();
    } else {
        echo "Gagal memperbarui data: " . $koneksi->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Kepala</title>
    <!-- Template untuk font-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Css-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>

<body id>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-8AA65A sidebar " id="bg-custom">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3" id="user-head">KEPALA UNIT KERJA</div>
            </a>

            <hr class="sidebar-divider my-0">
            <img alt="Profile Picture" src="images.jpg" class="profile-image"/>
            <p ><?php echo htmlspecialchars($_SESSION['nama']); ?></p>

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-bell"></i>
                    <span>Riwayat Cuti</span>
                </a>
            </li>
            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

        <!--Navbar-->
        <nav class="navbar navbar-expand navbar-light topbar navbar-custom">

                    <!-- Garis tiga buat nampilin sidebar -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    
                    <ul class="navbar-nav ml-auto">
                                               
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Profile -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white-600 small"><?php echo htmlspecialchars($_SESSION['nama']); ?></span>
                                <img class="img-profile rounded-circle"
                                    src="images.jpg">
                            </a>
                            <!-- Kunjungi profile -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                               <!-- Keluar dari akun --> 
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of navbar -->

            <!-- Main Content -->
            <div id="content">
                

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="form-container">
    <div class="container mt-5">
        <h2>Ubah Profil</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" class="form-control" 
                    value="<?php echo htmlspecialchars($user['alamat']); ?>" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No Telp:</label>
                <input type="text" id="no_telp" name="no_telp" class="form-control"
                    value="<?php echo htmlspecialchars($user['no_telp']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary text-white">Simpan</button>
            <a href="profil.php" class="btn btn-secondary text-white">Batal</a>
        </form>
    </div>
</body>

</html>
