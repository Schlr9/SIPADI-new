<?php
include 'config.php'; // Include file konfigurasi database

// Periksa apakah parameter ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buat query DELETE untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM penggilingan WHERE ID = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter ID ke query
        $stmt->bind_param("i", $id);
        
        // Eksekusi query
        if ($stmt->execute()) {
            // Jika berhasil, redirect ke halaman utama atau halaman lain
            header("Location: penggilingan.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Tutup statement
        $stmt->close();
    }
    
    // Tutup koneksi
    $conn->close();
} else {
    echo "ID tidak ditemukan.";
}

