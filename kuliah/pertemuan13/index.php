<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("location: login.php");
  exit;
}

// koneksi ke function
require 'functions.php';
// Tampung ke Variable Mahasiswa
$mahasiswa = Query("SELECT * FROM mahasiswa");

// ketika tombol cari diklik
if (isset($_POST['cari'])) {
  $mahasiswa = cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>
  <a href="logout.php">Logout</a>

  <h3>Daftar Mahasiswa</h3>

  <a href="tambah.php">Tambah Daftar Mahasiswa</a>
  <br><br>

  <form action="" method="post">
    <input type="text" name="keyword" size="40" placeholder="masukkan keyword pencarian" autocomplete="off" autofocus class="keyword">
    <button type="submit" name="cari" class="tombol-cari">Cari</button>
  </form>
  <br>

  <div class="container">
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>#</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Aksi</th>
      </tr>

      <?php if (empty($mahasiswa)) : ?>
        <tr>
          <td colspan="4">
            <p style="color: red; font-style: italic;">data mahasiswa tidak ditemukan!</p>
          </td>
        </tr>
      <?php endif; ?>

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
  </div>

  <script src="js/script.js"></script>
</body>

</html>