<?php
// Pastikan Anda telah memasukkan file koneksi database
require "include/conn.php";

// Pastikan variabel $_GET['id'] ada dan tidak kosong
if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    // Ambil id_criteria dari parameter URL
    $id_criteria = $_GET['id'];

    // Buat query untuk menghapus kriteria dari database
    $sql = "DELETE FROM `saw_criterias` WHERE id_criteria = '$id_criteria'";

    // Jalankan query
    if ($db->query($sql)) {
        // Jika penghapusan berhasil, beri pesan sukses
        echo "<script>alert('Kriteria telah dihapus!'); window.location.href = './bobot.php';</script>";
    } else {
        // Jika terjadi kesalahan dalam penghapusan, beri pesan gagal
        echo "<script>alert('Gagal menghapus kriteria!'); window.location.href = './bobot.php';</script>";
    }
} else {
    // Jika id_criteria tidak ada atau kosong, beri pesan kesalahan
    echo "<script>alert('ID Kriteria tidak valid!'); window.location.href = './bobot.php';</script>";
}
?>