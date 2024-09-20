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
                         

            <ul
              class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end"
            >
              <li class="active"><a href="index.php">Beranda</a></li>
              <li><a href="input.php">Input Data</a></li>
              <li><a href="penggilingan.php">Data Penggilingan</a></li>
              <li><a href="profil.php">Lanjutan</a></li>
            </ul>

            <a
              href="#"
              class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
              data-toggle="collapse"
              data-target="#main-navbar"
            >
              <span></span>
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div class="hero page-inner1 overlay"
          style="background-image: url('images/padi2.jpg')">
      <div class="hero-slide">
        
       
        <div class="container p-5">
        <div class="row justify-content-center align-items-center pt-5 px-5">
          <div class="col-lg-9 text-center mt-5">
          
        <?php
include 'config.php';

// Query untuk menghitung total data
$sql_total = "SELECT COUNT(*) as total_data FROM penggilingan";
$result_total = $conn->query($sql_total);
$total_data = $result_total->fetch_assoc()['total_data'];

// Query untuk menghitung jumlah data per kecamatan
$sql_kecamatan = "SELECT kecamatan, COUNT(*) as jumlah_data 
                  FROM penggilingan 
                  GROUP BY kecamatan";
$result_kecamatan = $conn->query($sql_kecamatan);

// Tampilkan data persentase
if ($result_kecamatan->num_rows > 0) {
   
    echo "<table class='styled-table'>
            <thead>
            <tr>
                <th>Kecamatan</th>
                <th>Jumlah Data</th>
                <th>Persentase</th>
            </tr>
            </thead>";
    
    while ($row = $result_kecamatan->fetch_assoc()) {
        $persentase = ($row['jumlah_data'] / $total_data) * 100;
        echo "  <tbody>
                <tr>
                <td>" . $row['kecamatan'] . "</td>
                <td>" . $row['jumlah_data'] . "</td>
                <td>" . number_format($persentase, 2) . "%</td>
              </tr>
              </tbody>";
    }
    
    echo "</table>";
} else {
    echo "Tidak ada data yang tersedia.";
}

$conn->close();
?>
</div>
</div>
</div>
</div>
        
      </div>
      
      </div>
      
    </div>
<!-- .item -->
 
<div class="row mt-5">
      <div class="col-12 text-center">
        <p>
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script>
          . All Rights Reserved. &mdash; Designed with love by
          <a>Schl</a>
        </p>
        <div>
          Distributed by
          <a target="_blank">Schl</a>
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
