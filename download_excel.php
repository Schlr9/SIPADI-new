<?php
require 'vendor/autoload.php'; // Load PHPSpreadsheet jika menggunakan Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Include koneksi ke database
include 'config.php';

// Buat Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header kolom untuk file Excel
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'Nama Emulator');
$sheet->setCellValue('C1', 'Kecamatan');
$sheet->setCellValue('D1', 'Bulan');
$sheet->setCellValue('E1', 'Volume Gilingan');
$sheet->setCellValue('F1', 'Nama Responden');
$sheet->setCellValue('G1', 'Nama Penggilingan');
$sheet->setCellValue('H1', 'Jenis Beras');
$sheet->setCellValue('I1', 'Volume Gilingan Sebulan');
$sheet->setCellValue('J1', 'Volume Hasil Gilingan Sebulan');
$sheet->setCellValue('K1', 'Volume Penjualan Beras Sebulan');
$sheet->setCellValue('L1', 'Asal Gabah');

// Query untuk mendapatkan data dari database
$sql = "SELECT nama_emulatro, kecamatan, bulan, kapasitas, nama_responden, nama_penggilingan, jenis_beras, vol_gilingan, vol_hasil, vol_penjualan, asal_gabah 
        FROM penggilingan";
$result = $conn->query($sql);

// Cek apakah data ditemukan
if ($result->num_rows > 0) {
    $rowNum = 2; // Baris awal untuk data
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        // Isi baris dengan data dari database
        $sheet->setCellValue('A' . $rowNum, $counter);
        $sheet->setCellValue('B' . $rowNum, $row['nama_emulatro']);
        $sheet->setCellValue('C' . $rowNum, $row['kecamatan']);
        $sheet->setCellValue('D' . $rowNum, $row['bulan']);
        $sheet->setCellValue('E' . $rowNum, $row['kapasitas']);
        $sheet->setCellValue('F' . $rowNum, $row['nama_responden']);
        $sheet->setCellValue('G' . $rowNum, $row['nama_penggilingan']);
        $sheet->setCellValue('H' . $rowNum, $row['jenis_beras']);
        $sheet->setCellValue('I' . $rowNum, $row['vol_gilingan']);
        $sheet->setCellValue('J' . $rowNum, $row['vol_hasil']);
        $sheet->setCellValue('K' . $rowNum, $row['vol_penjualan']);
        $sheet->setCellValue('L' . $rowNum, $row['asal_gabah']);
        $rowNum++;
        $counter++;
    }
}

// Nama file yang akan di-download
$filename = 'Data_Penggilingan.xlsx';

// Set header HTTP agar browser memahami file yang dikirim sebagai Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Buat Writer untuk menyimpan file Excel
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Tutup koneksi database
$conn->close();
exit;
