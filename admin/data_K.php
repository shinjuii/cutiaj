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
    <title>Data Kepala Unit Kerja</title>
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

            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3" id="user-head">ADMIN</div>
            </a>

            <hr class="sidebar-divider my-0">
            <img alt="Profile Picture" src="images.jpg" class="profile-image"/>
            <p ><?php echo htmlspecialchars($_SESSION['nama']); ?></p>

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-file-alt text-white"></i>
                    <span>Data Pegawai</span></a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item active">
                <a class="nav-link" href="#" >
                    <i class="fas fa-file-alt text-white"></i>
                    <span>Data Kepala Unit Kerja</span>
                </a>
            </li>


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
                                <a class="dropdown-item" href="#">
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
                <!-- End of Navbar -->

            <!-- Main Content -->
            <div id="content">
                

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Judul -->
                    <div class="card">
                        <div class="card-body">
                            DATA KEPALA UNIT KERJA
                        </div>
                    </div>

                    <!-- Button -->
                    <button>
                    <a href="tambahdataK.php" class="btn btn-primary p-2 text-white float-right"><i class="fas fa-plus mr-2"></i>Tambah Data Kepala Unit kerja</a>
                    </button>
                    
                    <!-- Tabel -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Id Kepala Unit Kerja</th>
                            <th scope="col">Nama Kepala Unit Kerja</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Role</th>
                            <th scope="col">Kode Departemen</th>
                            <th colspan="3" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include "../koneksi.php";
                            $sql = "SELECT * FROM user WHERE role = 'kepala';";
                            $query = mysqli_query($koneksi, $sql);
                            if (mysqli_num_rows($query) < 1) : ?>
                            <tr>
                                <td colspan="100%">Tidak ada data yang ditemukan !</td>
                            </tr>
                                <?php
                                endif;
                                foreach ($query as $key => $value) :
                                ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['id_user'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['username'] ?></td>
                                <td><?= $value['password'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['no_telp'] ?></td>
                                <td><?= $value['role'] ?></td>
                                <td><?= $value['kode_departemen'] ?></td>
                                <td>
                                    <a href="editdataK.php?id_user=<?php echo $value['id_user']; ?>" class="btn"><i class="fas fa-edit mr-2"></i> Ubah</a>
                                    <a href="hapusdata.php?id_user=<?php echo $value['id_user']; ?>" class="btn-delete"><i class="fas fa-trash-alt mr-2"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        
                    </table>

                    
                        

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>