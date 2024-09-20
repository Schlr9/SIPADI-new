<?php
include 'config.php';
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil token dari URL
$token = $_GET['token'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Cek apakah token valid
    $sql = "SELECT * FROM user WHERE reset_token = ? AND token_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update password
        $sql = "UPDATE user SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $new_password, $token);
        $stmt->execute();

        header('Location: login.php');
        exit();
    } else {
        echo "Token tidak valid atau telah kedaluwarsa.";
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
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />

    <title>SIPADI &mdash; </title>
    
    <style>
      .brand-name {
        font-size: 30px; 
        font-weight: bold; 
        color: #f4f4f4; 
        font-family: 'Work Sans', sans-serif; 
        letter-spacing: 3px; 
        text-transform: uppercase; 
        display: inline-block;
        vertical-align: middle; 
      }

      @media (max-width: 768px) {
        .brand-name {
          font-size: 40px; 
        }
      }
    </style>
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

    <div class="hero page-inner1 overlay" style="background-image: url('images/padi2.jpg')">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Reset Sandi</h1>
            <form method="POST">
              <div class="input-group mb-3">
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Masukkan kata sandi baru" required>
              </div>
              <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
              
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
