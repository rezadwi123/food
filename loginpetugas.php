<?php
// memanggil config
include 'config.php';
session_start();

// proses login petugas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil inputan user
    $username = $_POST['username'];
    $password = $_POST['password'];

    // kueri data
    $query = "SELECT id_petugas, username FROM petugas WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    // memeriksa hasil kueri
    if ($result && mysqli_num_rows($result) > 0) {
        // Authentication successful, berpindah ke home petugas
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_data['id_petugas'];
        header("Location: homeadmin.php");
        exit();
    } else {
        // Authentication failed, menampilkan error message
        $error_message = "*Invalid username or password";
    }
}

// menutup koneksi ke database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORTAL PENGADUAN MASYRAKAT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Roboto:wght@400; 500; 700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(A.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="text-white">
    <h1 class="text-center mt-5">PORTAL PENGADUAN MASYRAKAT</h1>
    <h3 class="text-center mt-5" style="color:#8acaff">LOGIN PETUGAS</h3>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <?php if (isset($error_message)) { ?>
                    <p class="mt-4" style="color: red;"><?php echo $error_message; ?></p>
                <?php } ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <a class="col-6 d-grid btn btn-secondary" href="index.php">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>