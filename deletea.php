<?php
session_start();
include 'config.php'; // Koneksi ke database

// Cek apakah pengguna sudah login dan memiliki ID
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Cek apakah ID yang valid telah diterima melalui URL
if (isset($_GET['id']) && intval($_GET['id']) == $user_id) {
    $id = intval($_GET['id']);

    // Hapus akun dari database
    $stmt = $conn->prepare("DELETE FROM user WHERE ID = ?");
    $stmt->bind_param("i", $id);  // "i" berarti integer


    if ($stmt->execute()) {
        // Hapus akun berhasil, logout pengguna
        session_destroy();
        echo "<script>alert('Akun Anda telah dihapus.'); window.location.href='login.php';</script>";
    } else {
        // Gagal menghapus akun
        echo "<script>alert('Terjadi kesalahan saat menghapus akun. Silakan coba lagi.'); window.location.href='profil.php';</script>";
    }

    $stmt->close();
} else {
    // Jika ID tidak valid atau bukan milik pengguna yang sedang login
    echo "<script>alert('ID pengguna tidak valid.'); window.location.href='profil.php';</script>";
}

$conn->close();
