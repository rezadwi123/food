<?php
// memanggil config
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: loginpetugas.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // mengambil data tanggapan
    if (!isset($_GET['id_pengaduan'])) {
        // jika tidak membawa data id tanggapan, kembalikan ke tabel pengaduan
        header("Location: tablepengaduanpetugas.php");
        exit();
    }
    $id_pengaduan = $_GET['id_pengaduan'];

    // kueri data
    $query = "SELECT * FROM pengaduan WHERE id_pengaduan = $id_pengaduan";
    $result = mysqli_query($koneksi, $query);
    $pengaduan = mysqli_fetch_assoc($result);
} else {
    // data input
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_pengaduan = $_POST['tgl_pengaduan'];
    $tgl_tanggapan = date('Y-m-d H:i:s');
    $tanggapan = $_POST['tanggapan'];
    $id_petugas = $_SESSION['user_id'];

    // kueri data pengaduan
    $query = "SELECT * FROM pengaduan WHERE id_pengaduan = $id_pengaduan";
    $result = mysqli_query($koneksi, $query);
    $pengaduan = mysqli_fetch_assoc($result);

    // kueri data
    $query = "SELECT * FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'";
    $result = mysqli_query($koneksi, $query);
    $data_tanggapan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (count($data_tanggapan) > 0) {
        // pengaduan telah memiliki tanggapan maka data tanggapan akan diupdate
        $id_tanggapan = $data_tanggapan[0]['id_tanggapan'];
        $updateQuery = "UPDATE tanggapan SET tgl_tanggapan='$tgl_tanggapan', tanggapan='$tanggapan', id_petugas=$id_petugas WHERE id_tanggapan=$id_tanggapan";
        $updateResult = mysqli_query($koneksi, $updateQuery);

        // success message
        $message = "Perubahan tanggapan berhasil";
    } else {
        // pengaduan tidak memiliki tanggapan
        $insertQuery = "INSERT INTO tanggapan 
                        (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) 
                        VALUES ($id_pengaduan,'$tgl_tanggapan','$tanggapan',$id_petugas)";
        $insertResult = mysqli_query($koneksi, $insertQuery);
        // success message
        $message = "Penambahan tanggapan berhasil";
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
    <h3 class="text-center mt-5" style="color:#8acaff">FORM TANGGAPAN PENGADUAN</h3>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <?php if (isset($message)) { ?>
                    <p class="mt-4" style="color: green;"><b><?php echo $message; ?></b></p>
                <?php } ?>
                <form method="post" action="" class="">
                    <div class="form-group">
                        <label>ID Pengaduan</label>
                        <input value="<?= $pengaduan['id_pengaduan']; ?>" type="text" id="id_pengaduan" name="id_pengaduan" class="form-control" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="isi_laporan">Isi Laporan</label>
                        <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="3" readonly><?= $pengaduan['isi_laporan']; ?></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label>Tanggal Pengaduan</label>
                        <input value="<?= $pengaduan['tgl_pengaduan']; ?>" type="datetime" id="tgl_pengaduan" name="tgl_pengaduan" class="form-control" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="tanggapan">Tanggapan</label>
                        <textarea class="form-control" id="tanggapan" name="tanggapan" rows="3" required></textarea>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <a class=" d-grid btn btn-secondary" href="tablepengaduanpetugas.php">
                                Kembali
                            </a>
                        </div>
                        <div class="col-6 d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>