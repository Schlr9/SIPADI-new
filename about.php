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
      Tentang &mdash; 
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
              <li ><a href="index.php">Beranda</a></li>
              <li class="active"><a href="about.html">Tentang</a></li>
              <li><a href="profil.php">Profil</a></li>
              <li><a href="logout.php">Keluar</a></li>
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
            <h1 class="heading" data-aos="fade-up">Tentang</h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                  Tentang
                </li>
                Adanya Website SIPADI ( Sistem Data Penggilingan Padi) ini bertujuan untuk Mempermudah proses pengelolaan data penggilingan padi, termasuk pemesanan, produksi, dan distribusi, sehingga dapat meningkatkan efisiensi. Memberikan akses transparan terhadap informasi terkait penggilingan padi, termasuk volume produksi, jenis beras, dan data responden, yang dapat membantu dalam pengambilan keputusan.
              </ol>
            </nav>
            
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
