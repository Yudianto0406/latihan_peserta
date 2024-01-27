<?php
include("koneksi.php");
$sql = "SELECT * FROM peserta";
$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>CRUD Peserta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-primary"><h2>CRUD Peserta</h2></span>
        </div>
    </nav>
    <div class="container">
        <h1>Latihan CRUD menyimpan peserta dan foto</h1>
    <a href="form_tambah.php" class="btn btn-primary">Tambah Peserta</a>
    <br><br>
    <table class="table table-dark table-striped">
        <thead>
            <tr class="bg-dark text-white">
                <th>No</th>
                <th>Nama</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td><img src='images/" . $row['foto'] . "' width='100' height='100'></td>";
                echo "<td>";
                echo "<a href='form_edit.php?id=" . $row['id'] . "' class='btn btn-info'>Edit</a> | ";
                echo "<a href='hapus.php?id=" . $row['id'] . "' class='btn btn-danger'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
    </div>
    </div>
</body>

</html>