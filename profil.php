<?php
session_start();

include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
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
    
    <title>SIPADI &mdash; Profil Pengguna</title>
  </head>
  
  <body>
    <!-- Navigation Bar -->
    <nav class="site-nav">
      <div class="container">
        <div class="menu-bg-wrap">
          <div class="site-navigation">
            <a href="index.php">
              <img src="images/logoo.png" alt="Logo SIPADI" width="70" height="70" style="margin-right: 10px;">
              <span class="brand-name">SIPADI</span>
            </a>
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
            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
              <li><a href="index.php">Beranda</a></li>
              <li><a href="about.php">Tentang</a></li>
              <li class="active"><a href="profil.php">Profil</a></li>
              <li><a href="logout.php">Keluar</a></li>
            </ul>
            <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none">
              <span></span>
            </a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero page-inner1 overlay" style="background-image: url('images/padi2.jpg')">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Profil Pengguna</h1>

            <?php
            // Fetch user data based on session ID
            $stmt = $conn->prepare("SELECT ID, namad, namab, email FROM user WHERE ID = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
            ?>
                <div class="profile-container">
                  <div class="row mb-3">
                    <label for="namad" class="col-sm-2 col-form-label">Nama Depan:</label>
                    <div class="col-sm-10">
                      <span class="input-group-text"><?php echo htmlspecialchars($user['namad']); ?></span>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="namab" class="col-sm-2 col-form-label">Nama Belakang:</label>
                    <div class="col-sm-10">
                      <span class="input-group-text"><?php echo htmlspecialchars($user['namab']); ?></span>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                      <span class="input-group-text"><?php echo htmlspecialchars($user['email']); ?></span>
                    </div>
                  </div>
                </div>

                <!-- Profile Action Buttons -->
                <div class="profile-actions">
                  <a href="editp.php?id=<?php echo $user['ID']; ?>" class="btn btn-primary">Edit Profil</a>
                  <a href="ubah_password.php?id=<?php echo $user['ID']; ?>" class="btn btn-warning">Ubah Password</a>
                  <button type="button" onclick="confirmDelete('<?php echo $user['ID']; ?>')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#popupModalDel">
                      Hapus Akun
                  </button>

                  <?php require_once('modaldel.php'); ?>
                </div>

            <?php
            } else {
                echo "<p>ID pengguna tidak valid atau data tidak ditemukan.</p>";
            }

            $stmt->close();
            $conn->close();
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="row mt-5">
      <div class="col-12 text-center">
        <p>
          Copyright &copy;
          <script>document.write(new Date().getFullYear());</script>
          . All Rights Reserved. &mdash; Designed with love by
          <a>Schl</a>
        </p>
        <div>Distributed by <a target="_blank">Schl</a></div>
      </div>
    </div>

    <!-- Loading Overlay -->
    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Delete Confirmation Script -->
    <script>
      function confirmDelete(id) {
          // Update the delete link based on the user ID
          document.getElementById('confirmDeleteBtn').href = "deletea.php?id=" + id;
          
          // Show the delete confirmation modal
          var modal = new bootstrap.Modal(document.getElementById('popupModalDel'));
          modal.show();
      }
    </script>

    <!-- JavaScript files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
