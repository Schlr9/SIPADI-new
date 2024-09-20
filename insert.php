<?php 
include 'config.php';

// Mengambil data dari POST
$nama_emulatro = isset($_POST['nama_emulatro']) ? $_POST['nama_emulatro'] : null;
$kecamatan = isset($_POST['kecamatan']) ? $_POST['kecamatan'] : null;
$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : null;
$kapasitas = isset($_POST['kapasitas']) ? $_POST['kapasitas'] : null;
$nama_responden = isset($_POST['nama_responden']) ? $_POST['nama_responden'] : null;
$nama_penggilingan = isset($_POST['nama_penggilingan']) ? $_POST['nama_penggilingan'] : null;
$jenis_beras = isset($_POST['jenis_beras']) ? $_POST['jenis_beras'] : null;
$vol_gilingan = isset($_POST['vol_gilingan']) ? $_POST['vol_gilingan'] : null;
$vol_hasil = isset($_POST['vol_hasil']) ? $_POST['vol_hasil'] : null;
$vol_penjualan = isset($_POST['vol_penjualan']) ? $_POST['vol_penjualan'] : null; // Corrected variable name
$asal_gabah = isset($_POST['asal_gabah']) ? $_POST['asal_gabah'] : null;

// Check if vol_penjualan is null
if ($vol_penjualan === null) {
    die("Error: 'vol_penjualan' cannot be null."); // Handle error appropriately
}

// Menyiapkan statement SQL
$sql = "INSERT INTO penggilingan (nama_emulatro, kecamatan, bulan, kapasitas, nama_responden, nama_penggilingan, jenis_beras, vol_gilingan, vol_hasil, vol_penjualan, asal_gabah) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    // Mengikat parameter
    $stmt->bind_param("sssssssssss", $nama_emulatro, $kecamatan, $bulan, $kapasitas, $nama_responden, $nama_penggilingan, $jenis_beras, $vol_gilingan, $vol_hasil, $vol_penjualan, $asal_gabah);

    // Menjalankan statement
    if ($stmt->execute()) {
        header("Location: penggilingan.php?message=Data berhasil diperbarui");
        exit(); // Use exit after header redirect
    } else {
        echo "Error memasukkan data: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
} else {
    echo "Error dalam menyiapkan statement: " . $conn->error;
}

// Menutup koneksi
$conn->close();
