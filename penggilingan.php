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
                <li><a href="input.php">Input Data</a></li>
                <li class="active"><a href="penggilingan.php">Data Penggilingan</a></li>
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
      class="hero page-inner2 overlay"
      style="background-image: url('images/padi2.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center pt-5 pb-0">
         
              <table class="styled-table"  data-aos="fade-up" >
            
            <thead>
                <tr>
              <th>No.</th>
              <th>Nama Emulator</th>
              <th>Kecamatan</th>
              <th>Bulan</th>
              <th>Volume Gilingan</th>
              <th>Nama Responden</th>
              <th>Nama Penggilingan</th>
              <th>Jenis Beras</th>
              <th>Volume Gilingan Sebulan</th>
              <th>Volume Hasil Gilingan Sebulan</th>
              <th>Volume Penjualan Beras Sebulan</th>
              <th>Asal Gabah</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
                
            <?php


include 'config.php';


$limit = 10;


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$sql_count = "SELECT COUNT(*) AS total FROM penggilingan";
$result_count = $conn->query($sql_count);
$total_rows = $result_count->fetch_assoc()['total'];


$total_pages = ceil($total_rows / $limit);


$sql = "SELECT ID, nama_emulatro, kecamatan, bulan, kapasitas, nama_responden, nama_penggilingan, jenis_beras, vol_gilingan, vol_hasil, vol_penjualan, asal_gabah 
        FROM penggilingan 
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = $offset + 1; 
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $counter . "</td>"; 
        echo "<td>" . $row['nama_emulatro'] . "</td>";
        echo "<td>" . $row['kecamatan'] . "</td>";
        echo "<td>" . $row['bulan'] . "</td>";
        echo "<td>" . $row['kapasitas'] . "</td>";
        echo "<td>" . $row['nama_responden'] . "</td>";
        echo "<td>" . $row['nama_penggilingan'] . "</td>";
        echo "<td>" . $row['jenis_beras'] . "</td>";
        echo "<td>" . $row['vol_gilingan'] . "</td>";
        echo "<td>" . $row['vol_hasil'] . "</td>";
        echo "<td>" . $row['vol_penjualan'] . "</td>";
        echo "<td>" . $row['asal_gabah'] . "</td>";
        echo "<td>" 
                . "<a href='edit.php?id=" . $row['ID'] . "'><button type='button' class='button-13'>Edit</button></a>"
                . "<button type='button' onclick='confirmDelete(" . $row['ID'] . ")' class='btn btn-danger button-13' data-bs-toggle='modal' data-bs-target='#popupModalDel'>
                      Hapus
                  </button>"
                . "</td>";
                require_once('modaldeld.php');
        echo "</tr>";
        
        $counter++;
    }
} else {
    echo "<tr><td colspan='13'>Tidak Ada Data</td></tr>"; 
}


$conn->close();
?>



                    
                
               
            </tbody>
            <tfoot>
    <tr>
      <th colspan="13" style="text-align: center;">
         <a href="download_excel.php" #f4f4f4><button type="button" class="btn btn-primary">Download Excel</button></a>
        </th>
    </tr>
  </tfoot>
            </table>
            
          
            <div class="pagination">
    <?php
    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '">&laquo; Sebelumnya</a>';
    }

   
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo '<a class="active">' . $i . '</a>';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    }

   
    if ($page < $total_pages) {
        echo '<a href="?page=' . ($page + 1) . '">Berikutnya &raquo;</a>';
    }
    ?>
</div>

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

    <script>
      function confirmDelete(id) {
          // Update the delete link based on the user ID
          document.getElementById('confirmDeleteBtn').href = "delete.php?id=" + id;
          
          // Show the delete confirmation modal
          var modal = new bootstrap.Modal(document.getElementById('popupModalDel'));
          modal.show();
      }
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
