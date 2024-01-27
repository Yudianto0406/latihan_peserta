<?php
include("koneksi.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM peserta WHERE id='$id'";
    $query = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($query);
} else {
    die("Data tidak ditemukan: " . mysqli_error($koneksi));
}
if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $path = "images/" . $foto;
    if (empty($foto)) {
        $sql = "UPDATE peserta SET nama='$nama' WHERE id='$id'";
        $query = mysqli_query($koneksi, $sql);
        if ($query) {
            header('Location: index.php');
        } else {
            die("Gagal mengedit data: " . mysqli_error($koneksi));
        }
    } else {
        if (move_uploaded_file($tmp, $path)) {
            $sql = "UPDATE peserta SET nama='$nama', foto='$foto' WHERE id='$id'";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                header('Location: index.php');
            } else {
                die("Gagal mengedit data: " . mysqli_error($koneksi));
            }
        } else {
            die("Gagal mengupload foto: " . mysqli_error($koneksi));
        }
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
        <h1>Edit Peserta</h1>
        <form action="form_edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <br>
                <img src="images/<?php echo $row['foto']; ?>" width="100" height="100">
                <br>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>
            <button type="submit" class="btn btn-primary" name="edit">Edit</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>