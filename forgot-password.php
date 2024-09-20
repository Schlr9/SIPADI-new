<?php

include 'config.php';
// Mulai sesi
session_start();
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$popupMessage = ""; // Variabel untuk menampung pesan popup

// Proses permintaan reset password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Cek apakah email ada di database
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Buat token unik untuk reset password
        $token = bin2hex(random_bytes(50));

        // Simpan token di database
        $sql = "UPDATE user SET reset_token = ?, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $token, $email);
        $stmt->execute();

        // Link untuk reset password
        $reset_link = "http://localhost/reset_password.php?token=" . $token;

        // Kirim email dengan link reset password
        $subject = "Reset Password";
        $message = "Klik link berikut untuk mereset kata sandi Anda: " . $reset_link;
        $headers = "From: no-reply@localhost";

        if (mail($email, $subject, $message, $headers)) {
            // Set pesan popup sukses
            $popupMessage = "Link reset password telah dikirim ke email Anda.";
        } else {
            // Set pesan popup gagal
            $popupMessage = "Gagal mengirim email.";
        }
    } else {
        // Set pesan popup jika email tidak ditemukan
        $popupMessage = "Email tidak ditemukan.";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>
        SIPADI &mdash; Lupa Sandi
    </title>
</head>

<body class="bg-gradient-primary">

<div class="hero page-inner1 overlay" style="background-image: url('images/padi2.jpg')">

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
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Lupa Sandi Anda?</h1>
                                        <p class="mb-4">Kita akan memperbaiki akun anda. Cukup masukan email anda,
                                            kita akan mengirim link untuk reset sandi anda</p>
                                    </div>
                                    <form method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Masukan Alamat Email...">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Reset Sandi</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Buat Akun!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Sudah Memiliki Akun? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Modal untuk pesan sukses/gagal -->
    <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Informasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $popupMessage; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cek jika ada pesan popup
        var popupMessage = "<?php echo $popupMessage; ?>";
        if (popupMessage) {
            var popupModal = new bootstrap.Modal(document.getElementById('popupModal'));
            popupModal.show();
        }
    </script>

</div>
</body>

</html>
