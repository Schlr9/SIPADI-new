<?php
include 'config.php';

// Cek apakah parameter ID ada di URL, jika tidak, redirect ke halaman lain
if (!isset($_GET['id'])) {
    header(header: "Location: penggilingan.php");
    exit();
}

$id = $_GET['id']; // Ambil ID dari URL

// Jika form di-submit, lakukan update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_emulatro = $_POST['nama_emulatro'];
    $kecamatan = $_POST['kecamatan'];
    $bulan = $_POST['bulan'];
    $kapasitas = $_POST['kapasitas'];
    $nama_responden = $_POST['nama_responden'];
    $nama_penggilingan = $_POST['nama_penggilingan'];
    $jenis_beras = $_POST['jenis_beras'];
    $vol_gilingan = $_POST['vol_gilingan'];
    $vol_hasil = $_POST['vol_hasil'];
    $vol_beras_jual = $_POST['vol_beras_jual'];
    $asal_gabah = $_POST['asal_gabah'];

    // Update query untuk menyimpan perubahan ke database
    $sql_update = "UPDATE penggilingan 
                   SET nama_emulatro = ?, kecamatan = ?, bulan = ?, kapasitas = ?, nama_responden = ?, 
                       nama_penggilingan = ?, jenis_beras = ?, vol_gilingan = ?, vol_hasil = ?, vol_beras_jual = ?, asal_gabah = ?
                   WHERE ID = ?";
                   
    if ($stmt = $conn->prepare($sql_update)) {
        // Bind parameter ke query
        $stmt->bind_param("sssssssssssi", $nama_emulatro, $kecamatan, $bulan, $kapasitas, $nama_responden, $nama_penggilingan, $jenis_beras, $vol_gilingan, $vol_hasil, $vol_beras_jual, $asal_gabah, $id);
        
        // Eksekusi query
        if ($stmt->execute()) {
            header("Location: penggilingan.php?message=Data berhasil diperbarui");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

// Ambil data lama untuk ditampilkan di form
$sql = "SELECT * FROM penggilingan WHERE ID = ?";
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
      class="hero page-inner overlay"
      style="background-image: url('images/padi2.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Edit Data Penggilingan
            </h1>
            <form method="POST">
            <div class="input-group mb-3">
              <br>
              <input type="text" name="nama_emulatro" class="form-control" aria-label="Nama Enumerator" aria-describedby="basic-addon1"
              value="<?php echo htmlspecialchars($data['nama_emulatro']); ?>"  required><br><br>
            </div>
            
            <div class="input-group mb-3">
              <br>
              <input type="text" name="kecamatan" class="form-control" aria-label="Kecamatan" aria-describedby="basic-addon2"
              value="<?php echo htmlspecialchars($data['kecamatan']); ?>" required><br><br>
            </div>
            
            <div class="input-group mb-3">
            <span class="input-group-text">Bulan</span><br>
              <select name="bulan" class="form-select" aria-label="Default select example"
              value="<?php echo htmlspecialchars($data['bulan']); ?>" required>
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
              <select  name="kapasitas" class="form-select" aria-label="Kapasitas"
              value="<?php echo htmlspecialchars($data['kapasitas']); ?>" required>
                <option value="Besar">Besar</option>
                <option value="Sedang">Sedang/Menengah</option>
                <option value="Kecil">Kecil</option>
              </select><br><br>
            </div>
            
            <div class="input-group mb-3">
              <br>
              <input type="text" name="nama_responden"  class="form-control"  aria-label="Nama Responden" aria-describedby="basic-addon2" value="<?php echo htmlspecialchars($data['nama_responden']); ?>" required><br><br>
            </div>

            <div class="input-group mb-3">
              <br>
              <input type="text" name="nama_penggilingan"  class="form-control" aria-label="Nama Penggilingan" aria-describedby="basic-addon2" value="<?php echo htmlspecialchars($data['nama_penggilingan']); ?>" required><br><br>
            </div>

            <div class="input-group mb-3"><br>
              <input type="text" name="jenis_beras" class="form-control"  aria-label="Jenis Beras" aria-describedby="basic-addon2" value="<?php echo htmlspecialchars($data['jenis_beras']); ?>" required><br><br>
            </div>
            
            <div class="input-group mb-3">
              <span class="input-group-text">Volume Yg Digiling Selama Sebulan</span>
              <input type="number" name="vol_gilingan"  class="form-control" aria-label="Amount (to the nearest dollar)" step="0.001" 
              value="<?php echo htmlspecialchars($data['vol_gilingan']); ?>"
              required>
              <span class="input-group-text">ton/bulan</span>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">Volume Hasil Giling Selama Sebulan</span>
              <input type="number" name="vol_hasil"  class="form-control" aria-label="Amount (to the nearest dollar)" step="0.001" 
              value="<?php echo htmlspecialchars($data['vol_hasil']); ?>"
              required>
              <span class="input-group-text">ton/bulan</span>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">Volume Beras Yg Dijual Selama Sebulan</span>
              <input type="number" name="vol_beras_jual"  class="form-control" aria-label="Amount (to the nearest dollar)" step="0.001" 
              value="<?php echo htmlspecialchars($data['vol_beras_jual']); ?>"
              required>
              <span class="input-group-text">ton/bulan</span>
            </div>
            
            <div class="input-group mb-3">
              <span class="input-group-text">Asal Gabah</span>
              <select class="form-select" name="asal_gabah" aria-label="Default select example" value="<?php echo htmlspecialchars($data['nama_emulatro']); ?>">
                <option value="1">Petani</option>
                <option value="2">Pedagang/Pengumpul</option>
                <option value="3">Milik Sendiri</option>
                <option value="4">Lainnya
                </option>
              </select>
            </div>
            
          <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
          <a href="penggilingan.php" #f4f4f4><button type="button" class="btn btn-primary">Kembali</button></a>
          </form>
          

          </div>
        </div>
      </div>
    </div>

        <div class="row mt-5">
          <div class="col-12 text-center">
            <!-- 
              **==========
              NOTE: 
              Please don't remove this copyright link unless you buy the license here https://untree.co/license/  
              **==========
            -->

            <p>
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script>
              . All Rights Reserved. &mdash; Designed with love by
              <a href="https://untree.co">Untree.co</a>
              <!-- License information: https://untree.co/license/ -->
            </p>
            <div>
              Distributed by
              <a href="https://themewagon.com/" target="_blank">themewagon</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container -->
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
