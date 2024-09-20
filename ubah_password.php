<?php
session_start();
include 'config.php'; // Koneksi ke database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil ID pengguna dari sesi

// Jika form di-submit, lakukan update password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi apakah password baru dan konfirmasi password sama
    if ($new_password != $confirm_password) {
        echo "<script>alert('Password baru dan konfirmasi password tidak cocok.'); window.location.href='ubah_password.php';</script>";
        exit();
    }

    // Cek apakah password lama cocok dengan yang ada di database
    $sql = "SELECT password FROM user WHERE ID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($db_password);
        $stmt->fetch();
        $stmt->close();

        // Verifikasi password lama
        if (password_verify($current_password, $db_password)) {
            // Update password baru
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE user SET password = ? WHERE ID = ?";
            if ($stmt = $conn->prepare($sql_update)) {
                $stmt->bind_param("si", $new_password_hashed, $user_id);
                if ($stmt->execute()) {
                    echo "<script>alert('Password berhasil diubah.'); window.location.href='profil.php';</script>";
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        } else {
            echo "<script>alert('Password lama salah.'); window.location.href='ubah_password.php';</script>";
            exit();
        }
    }
}

$conn->close();
?>

<!-- Template HTML -->
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
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />

    <title>
      SIPADI &mdash; Ubah Password
    </title>
  </head>
  <body>
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icofont-close js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <div
      class="hero page-inner1 overlay"
      style="background-image: url('images/padi2.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Ubah Password</h1>
            <form method="POST">
              <div class="input-group mb-3">
                <input type="password" name="current_password" class="form-control" placeholder="Password Lama" required>
              </div>
              
              <div class="input-group mb-3">
                <input type="password" name="new_password" class="form-control" placeholder="Password Baru" required>
              </div>

              <div class="input-group mb-3">
                <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password Baru" required>
              </div>

              <input type="submit" class="btn btn-primary" value="Ubah Password">
              <a href="profil.php"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
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
