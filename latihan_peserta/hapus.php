<?php
include("koneksi.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM peserta WHERE id='$id'";
    $query = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($query);
    $foto = $row['foto'];
    $path = "images/" . $foto;
    if (file_exists($path)) {
        unlink($path);
    }
    $sql = "DELETE FROM peserta WHERE id='$id'";
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
        header('Location: index.php');
    } else {
        die("Gagal menghapus data: " . mysqli_error($koneksi));
    }
} else {
    die("Data tidak ditemukan: " . mysqli_error($koneksi));
}
?>