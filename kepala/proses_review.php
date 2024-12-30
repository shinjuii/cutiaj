<?php
include "../koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['action'])) {
    // Ambil data dari form
    $id_formulir = $_POST['id_formulir'];
    $action = $_POST['action'];

    // Cek apakah ada alasan penolakan
    $alasan_penolakan = isset($_POST['alasan_penolakan']) ? input($_POST['alasan_penolakan']) : null;

    // Jika disetujui
    if ($action === 'approve') {
        // Update status formulir menjadi disetujui
        $stmt = $koneksi->prepare("UPDATE formulir SET status = 'Disetujui' WHERE id_formulir = ?");
        $stmt->bind_param("i", $id_formulir);
        $stmt->execute();
    }
    // Jika ditolak
    elseif ($action === 'reject') {
        // Update status formulir menjadi ditolak dan simpan alasan penolakan
        $stmt = $koneksi->prepare("UPDATE formulir SET status = 'Ditolak', alasan_penolakan = ? WHERE id_formulir = ?");
        $stmt->bind_param("si", $alasan_penolakan, $id_formulir);
        $stmt->execute();
    }

    // Redirect atau tampilkan pesan sesuai kebutuhan
    header("Location: index.php"); // Ganti dengan halaman yang sesuai
    exit();
}

?>
