<?php
// koneksi ke function
require 'functions.php';
// Tampung ke Variable Mahasiswa
$mahasiswa = Query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>
  <h3>Daftar Mahasiswa</h3>

  <a href="tambah.php">Tambah Daftar Mahasiswa</a>
  <br><br>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Aksi</th>
    </tr>

    <?php $i = 1;
    foreach ($mahasiswa as $ms) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $ms['gambar']; ?>" width="60"></td>
        <td><?= $ms['nama']; ?></td>
        <td>
          <a href="detail.php?id=<?= $ms['id']; ?>">Lihat Detail</Details></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>