<?php
include("koneksi.php");
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $path = "images/" . $foto;
    $tanggal = date("Y-m-d");
    if (move_uploaded_file($tmp, $path)) {
        $sql = "INSERT INTO peserta (nama, foto) VALUES ('$nama', '$foto')";
        $query = mysqli_query($koneksi, $sql);
        if ($query) {
            header('Location: index.php');
        } else {
            die("Gagal menyimpan data: " . mysqli_error($koneksi));
        }
    } else {
        die("Gagal mengupload foto: " . mysqli_error($koneksi));
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Peserta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Peserta</h1>
        <form action="form_tambah.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            <a href="index.php" class="btn btn-danger">Batal</a>
        </form>
    </div>
</body>

</html>