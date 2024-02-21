<?php
// memanggil config
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $tgl_pengaduan = date('Y-m-d H:i:s');;
    $isi_laporan = $_POST['isi_laporan'];

    // memastikan masyarakat dengan nik yang diinputkan telah terdaftar atau tidak, jika belum maka ditambahkan terlebih dahulu
    $query = "SELECT * FROM masyarakat WHERE NIK = '$nik'";
    $result = mysqli_query($koneksi, $query);
    $masyarakat = mysqli_fetch_assoc($result);
    if ($masyarakat == null) {
        $query = "INSERT INTO masyarakat(NIK, nama, telp) VALUES ('$nik','$nama','$telp')";
        $result = mysqli_query($koneksi, $query);
    }
    $query = "INSERT INTO pengaduan(tgl_pengaduan, NIK, isi_laporan) 
                VALUES ('$tgl_pengaduan','$nik','$isi_laporan')";
    $result = mysqli_query($koneksi, $query);

    // success message
    $message = "Pengaduan anda telah terkirim";
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
    <h3 class="text-center mt-5" style="color:#8acaff">FORM PENGADUAN MASYARAKAT</h3>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <?php if (isset($message)) { ?>
                    <p class="mt-4" style="color: green;"><b><?php echo $message; ?></b></p>
                <?php } ?>
                <form method="post" action="" class="mt-4">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="number" id="nik" name="nik" class="form-control" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Nomor Telepon</label>
                        <input type="number" id="telp" name="telp" class="form-control" required>
                    </div>
                    <div class="form-group">
              <label>Tanggal Tanggapan</label>
              <input type="date" class="form-control" placeholder="Tanggal Tanggapan" name="tgl_tanggapan">
            </div>
                    <div class="form-group mt-2">
                        <label for="isi_laporan">Isi Laporan</label>
                        <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="3" required></textarea>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 d-grid">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        <div class="col-6">
                            <a class="d-grid btn btn-outline-secondary" href="tablepengaduan.php">
                                Lihat pengaduan lainnya
                            </a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="">
                            <a class="d-grid btn btn-outline-danger" href="index.php">
                                Kembali
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("tgl_pengaduan").valueAsDate = new Date();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>