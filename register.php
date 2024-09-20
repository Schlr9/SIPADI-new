<?php
// Koneksi ke database
include 'config.php'; // Pastikan Anda memiliki file config.php yang berisi konfigurasi koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $namad = $_POST['namad'];
    $namab = $_POST['namab'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    // Validasi apakah password dan repeat password sama
    if ($password === $repeat_password) {
        // Hash password sebelum disimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk menyimpan data ke database
        $query = "INSERT INTO user (namad, namab, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $namad, $namab, $email, $hashed_password);

        if ($stmt->execute()) {
            // Jika berhasil, redirect ke halaman login
            header("Location: login.php");
            exit();
        } else {
            echo "Registrasi gagal!";
        }

        $stmt->close();
    } else {
        echo "Kata sandi tidak cocok!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />  
    <link rel="shortcut icon" href="favicon.png" />
    
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />
    
    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />
    
    <title>
        SIPADI &mdash; Buat Akun Baru
    </title>
</head>

<body class="bg-gradient-primary">
<div
      class="hero page-inner1 overlay"
      style="background-image: url('images/padi2.jpg')"
    >
    <div class="container">
    
    <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
        <div class=" card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row position-relative">
                    <!-- Kolom gambar login -->
                    <div class="col-lg-6 d-none d-lg-block bg-register-image" 
                         style="background-image: url('images/5.png');">
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
                            </div>
                            <!-- Tambahkan method POST dan action untuk submit ke halaman ini -->
                            <form class="user" method="POST" action="">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="namad" id="exampleFirstName" placeholder="Nama Depan" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="namab" id="exampleLastName" placeholder="Nama Belakang" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Alamat Email" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Kata Sandi" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="repeat_password" id="exampleRepeatPassword" placeholder="Ulangi Kata Sandi" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block ">
                                    Daftar Akun
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Sudah Memiliki Akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
