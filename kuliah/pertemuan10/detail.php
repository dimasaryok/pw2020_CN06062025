<?php
require 'functions.php';

// ambil URL dari id
$id = $_GET['id'];

// query mahasiswa berdasarkan id
$ms = Query("SELECT * FROM mahasiswa WHERE id = $id ");


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Detail Mahasiswa </title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>
  <ul>
    <li><img src="img/<?= $ms['gambar']; ?>"></li>
    <li>NRP : <?= $ms['nrp']; ?> </li>
    <li>Nama : <?= $ms['nama']; ?></li>
    <li>Email : <?= $ms['email']; ?></li>
    <li>Jurusan : <?= $ms['jurusan']; ?></li>
    <li><a href="">Ubah</a> | <a href="">Hapus</a></li>
    <li><a href="latihan3.php">Kembali ke daftar mahasiswa</a></li>
  </ul>
</body>

</html>