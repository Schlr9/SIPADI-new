<?php
session_start();
include 'config.php';
// Cek apakah pengguna sudah login, jika iya, arahkan ke halaman index
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$login_error = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa email di database
    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email); // 's' untuk string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Gunakan password_verify jika password di database di-hash
        if (password_verify($password, $user['password'])) {
            // Simpan data pengguna di session
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['email'] = $user['email'];

            // Redirect ke halaman utama
            header("Location: index.php");
            exit();
        } if($login_error = true) {
            $title = "Login Gagal";
            $message = "Kata Sandi Salah, Ulangi";
        }include 'modal.php';

    } if($login_error = true) {
        // Email tidak ditemukan
        $title = "Login Gagal";
        $message = "Email Tidak Ditemukan";

    } include 'modal.php';


    $stmt->close();
}

$conn->close();
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
    
    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />
    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />
    
    <title>SIPADI &mdash; Login</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- JavaScript untuk menampilkan popup jika login gagal -->
    <script>
        function showErrorPopup() {
            alert("Email atau password salah!");
        }
    </script>
</head>

<body class="bg-gradient-primary">
<div
      class="hero page-inner1 overlay"
      style="background-image: url('images/padi2.jpg')"
    >
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row position-relative">
                    <!-- Kolom gambar login -->
                    <div class="col-lg-6 d-none d-lg-block bg-login-image" 
                         style="background-image: url('images/5.png');">
                    </div>
                    <!-- Kolom form login -->
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                            </div>

                            <!-- Form Login -->
                            <form class="user" method="POST" action="">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan Alamat Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Kata Sandi" required>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                        <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>

                            <!-- Include Modal -->
        <?php if ($login_error): ?>
            <?php include 'modal.php'; ?>
        <?php endif; ?>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Lupa Sandi?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.php">Buat Akun!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    </div>

    

   
    <!-- Tambahkan Bootstrap dan library lain -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showModal() {
            var popupModal = new bootstrap.Modal(document.getElementById('popupModal'));
            popupModal.show();
        }

        // Jika ada pesan popup, modal otomatis muncul
        <?php if ($login_error): ?>
                showModal();
            <?php endif; ?>
    </script>

</div>
</body>

</html>
