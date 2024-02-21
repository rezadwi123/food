<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: loginpetugas.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORTAL PENGADUAN MASYRAKAT</title>
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

        .btn {
            background-color: #8acaff;
            border-radius: 20px;
            color: black;
            font-weight: bold;
            text-decoration: none;
            margin: 10px;
            font-size: 28px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <section>
        <div style="text-align: center; color: white; font-size: 120px; margin-top: 140px; font-weight: bold;">
            Lapor Masyarakat
        </div>
        <div style="text-align: center; color: white; font-size: 25px; margin-top: 25px;">
            Managemen layanan pengaduan masyarakat secara real-time
        </div>
        <div style="text-align: center; margin-top: 100px;">
            <div class="row">
                <a href="tablepengaduanpetugas.php" class="col btn">Pengaduan</a>
                <a href="tabletanggapan.php" class="col btn">Tanggapan</a>
            </div>
            <div class="row" style="margin-top: 50px;">
                <a href="logout.php" class="col btn">Logout</a>
            </div>
        </div>
    </section>
</body>

</html>