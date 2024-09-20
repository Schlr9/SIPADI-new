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
                <li><a href="index.php">Beranda</a></li>
                <li class="active"><a href="input.html">Input Data</a></li>
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

    <div
      class="hero page-inner overlay"
      style="background-image: url('images/padi2.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Input Data Penggilingan
            </h1>
            <form action="insert.php" method="POST">
            <div class="input-group mb-3">
              <br>
              <input type="text" name="nama_emulatro" id="nama_emulatro" class="form-control" placeholder="Nama Enumerator" aria-label="Nama Enumerator" aria-describedby="basic-addon1"  required><br><br>
            </div>
            
            <div class="input-group mb-3">
              <br>
              <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Kecamatan" aria-label="Kecamatan" aria-describedby="basic-addon2" required><br><br>
            </div>
            
            <div class="input-group mb-3">
              <span class="input-group-text">Bulan</span><br>
              <select name="bulan" id="bulan" class="form-select" aria-label="Default select example" required>
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
              </select><br><br>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">Kapasitas Yang Digiling</span><br>
              <select id="kapasitas" name="kapasitas" class="form-select" aria-label="Default select example" required>
                <option value="Besar">Besar</option>
                <option value="Sedang">Sedang/Menengah</option>
                <option value="Kecil">Kecil</option>
              </select><br><br>
            </div>
            
            <div class="input-group mb-3">
              <br>
              <input type="text" name="nama_responden" id="nama_responden" class="form-control" placeholder="Nama Responden" aria-label="Nama Responden" aria-describedby="basic-addon2" required><br><br>
            </div>

            <div class="input-group mb-3">
              <br>
              <input type="text" name="nama_penggilingan" id="nama_penggilingan" class="form-control" placeholder="Nama Penggilingan" aria-label="Nama Penggilingan" aria-describedby="basic-addon2" required><br><br>
            </div>

            <div class="input-group mb-3"><br>
              <input type="text" name="jenis_beras" id="jenis_beras" class="form-control" placeholder="Jenis Beras" aria-label="Jenis Beras" aria-describedby="basic-addon2" required><br><br>
            </div>
            
            <div class="input-group mb-3">
              <span class="input-group-text">Volume Yg Digiling Selama Sebulan</span>
              <input type="number" name="vol_gilingan" id="vol_gilingan" class="form-control" aria-label="Amount (to the nearest dollar)" step="0.001" 
              placeholder="Contoh: 3.14"
              required>
              <span class="input-group-text">ton/bulan</span>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">Volume Hasil Giling Selama Sebulan</span>
              <input type="number" name="vol_hasil" id="vol_hasil" class="form-control" aria-label="Amount (to the nearest dollar)" step="0.001"
              placeholder="Contoh: 3.14"
              required>
              <span class="input-group-text">ton/bulan</span>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">Volume Beras Yg Dijual Selama Sebulan</span>
              <input type="number" name="vol_penjualan" id="vol_penjualan" class="form-control" aria-label="Amount (to the nearest dollar)" step="0.001"
              placeholder="Contoh: 3.14"
              required>
              <span class="input-group-text">ton/bulan</span>
            </div>
            
            <div class="input-group mb-3">
              <span class="input-group-text">Asal Gabah</span>
              <select class="form-select" name="asal_gabah" id="asal_gabah" aria-label="Default select example">
                <option value="1">Petani</option>
                <option value="2">Pedagang/Pengumpul</option>
                <option value="3">Milik Sendiri</option>
                <option value="4">Lainnya
                </option>
              </select>
            </div>
            
          <button type="submit" class="btn btn-primary" value="sumbit">
           Sumbit
          </button>
          </form>
          </div>
        </div>
      </div>
    </div>

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
