<?php
// memanggil config
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // kueri data
    $query = "SELECT * FROM pengaduan";
    $result = mysqli_query($koneksi, $query);
    $data_pengadaun = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $searchBy = $_POST['searchBy'];
    $keyword = $_POST['keyword'];
    // var_dump($keyword);

    // kueri data
    if ($searchBy == "tgl_pengaduan") {
        $query = "SELECT * FROM pengaduan WHERE tgl_pengaduan = '$keyword'";
    } else {
        $query = "SELECT * FROM pengaduan WHERE id_pengaduan = $keyword";
    }

    $result = mysqli_query($koneksi, $query);
    $data_pengadaun = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
// menutup koneksi ke database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Laporan Pengaduan</title>
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

<body>
    <h1 class="text-white text-center mt-5 mb-5">PORTAL PENGADUAN MASYRAKAT</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-10 ">
                <form method="post" action="" class="mt-5">
                    <div class="row gap-2">
                        <div class="col-2" style="font-size: 20px;">search</div>
                        <select class="col custom-select form-control" id="searchBy" name="searchBy" required>
                            <option value="" selected>Choose...</option>
                            <option value="tgl_pengaduan">tgl pengaduan</option>
                        </select>
                        <input type="text" class="col form-control" id="keyword" name="keyword" required>
                        <button type="submit" class="col-1 btn btn-primary">Cari</button>
                        <a style="color:white" href="tablepengaduan.php" class="col btn btn-secondary">Tampilkan Semua</a>
                    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <a href="pengaduan.php" class="mt-5 btn btn-secondary">Kembali</a>
                <table class="table text-center mt-2">
                    <thead class="table-info">
                        <tr>
                            <th scope="col">Tgl Pengaduan</th>
                            <th scope="col" width="70%">Isi Laporan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($data_pengadaun as $pengaduan) : ?>
                            <tr>
                                <td><?= $pengaduan['tgl_pengaduan']; ?></td>
                                <td><?= $pengaduan['isi_laporan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>