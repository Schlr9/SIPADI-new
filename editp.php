<?php
include 'config.php';

// Cek apakah parameter ID ada di URL, jika tidak, redirect ke halaman lain
if (!isset($_GET['id'])) {
    header(header: "Location: profil.php");
    exit();
}

$id = $_GET['id']; // Ambil ID dari URL

// Jika form di-submit, lakukan update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $namad = $_POST['namad'];
    $namab = $_POST['namab'];
    $email = $_POST['email'];
    

    // Update query untuk menyimpan perubahan ke database
    $sql_update = "UPDATE user 
                   SET namad = ?, namab = ?, email = ?
                   WHERE ID = ?";
                   
    if ($stmt = $conn->prepare($sql_update)) {
        // Bind parameter ke query
        $stmt->bind_param("sssi", $namad, $namab, $email, $id);
        
        // Eksekusi query
        if ($stmt->execute()) {
            header("Location: profil.php?message=Data berhasil diperbarui");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

// Ambil data lama untuk ditampilkan di form
$sql = "SELECT * FROM user WHERE ID = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!-- /*
* Template Name: Property
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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
      SIPADI &mdash; 
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

    <body>
      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>
  
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
            
            
            

    <div
      class="hero page-inner1 overlay"
      style="background-image: url('images/padi2.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Edit Data Profil
            </h1>
            <form method="POST">
            <div class="input-group mb-3">
              <br>
              <input type="text" name="namad" class="form-control" aria-label="Nama Depan" aria-describedby="basic-addon1"
              value="<?php echo htmlspecialchars($data['namad']); ?>"  required><br><br>
            </div>
            
            <div class="input-group mb-3">
              <br>
              <input type="text" name="namab" class="form-control" aria-label="Nama Belakang" aria-describedby="basic-addon2"
              value="<?php echo htmlspecialchars($data['namab']); ?>" required><br><br>
            </div>

            <div class="input-group mb-3">
              <br>
              <input type="text" name="email" class="form-control" aria-label="Alamat Email" aria-describedby="basic-addon2"
              value="<?php echo htmlspecialchars($data['email']); ?>" required><br><br>
            </div>
            
          <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
          <a href="profil.php" #f4f4f4><button type="button" class="btn btn-primary">Kembali</button></a>
          </form>
          

          </div>
        </div>
      </div>
    </div>

        
      
    <!-- /.site-footer -->

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
