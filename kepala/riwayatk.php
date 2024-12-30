<?php
session_start();
include "../koneksi.php"; 

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged') {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit(); 
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
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <div class="sidebar-brand-text mx-3" id="user-head">KEPALA UNIT KERJA</div>
            </a>

            <hr class="sidebar-divider my-0">
            <img alt="Profile Picture" src="images.jpg" class="profile-image"/>
            <p>Ibra Cihuy</p>

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ibra Cihuy</span>
                        <img class="img-profile rounded-circle" src="images.jpg">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
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

            <!-- Isi Content -->
            <div class="container-fluid">

                <!-- Judul -->
                <div class="card">
                    <div class="card-body">
                        Table Review
                    </div>
                </div>

                <!-- Tabel -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Jenis Cuti</th>
                            <th scope="col">Tanggal Diajukan</th>
                            <th scope="col">Status</th>
                            <th colspan="3" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query untuk mendapatkan data dengan status "Diproses"
                        $sql = "SELECT * FROM formulir WHERE status = 'disetujui' OR status = 'ditolak'";
                        $query = mysqli_query($koneksi, $sql);
                        
                        // Jika tidak ada data
                        if (mysqli_num_rows($query) < 1): ?>
                        <tr>    
                            <td colspan="100%">Tidak ada data yang ditemukan!</td>
                        </tr>
                        <?php endif;

                        // Tampilkan data
                        foreach ($query as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= htmlspecialchars($value['id_user']) ?></td>
                            <td><?= htmlspecialchars($value['jenis_cuti']) ?></td>
                            <td><?= htmlspecialchars($value['tanggal_diajukan']) ?></td>
                            <td><?= htmlspecialchars($value['status']) ?></td>
                            <td>
                                <a href="detail_riwayatk.php?id_formulir=<?= $value['id_formulir'] ?>" class="btn">
                                    <i class="fas fa-edit mr-2"></i> Review
                                </a>
                            </td>  
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
