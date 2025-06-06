<?php
// Koneksi ke DB & Pilih Database
$conn = mysqli_connect('localhost', 'root', '', 'pw_043040023');
// Query isi tabel Mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// Ubah isi tabel Mahasiswa
// $row = mysqli_fetch_row($result); // array numeric
// $row = mysqli_fetch_assoc($result); // array assosiative
// $row = mysqli_fetch_array($result); // menampilkan array numeric dan assosiative
$rows = []; // kurung siku menandakan Array kosong
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
} // array paling umum digunakan

// Tampung ke Variable Mahasiswa
$mahasiswa = $rows;
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
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>NRP</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Jurusan</th>
      <th>Aksi</th>
    </tr>

    <?php $i = 1;
    foreach ($mahasiswa as $ms) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $ms['gambar']; ?>" width="60"></td>
        <td><?= $ms['nrp']; ?></td>
        <td><?= $ms['nama']; ?></td>
        <td><?= $ms['email']; ?></td>
        <td><?= $ms['jurusan']; ?></td>
        <td>
          <a href="">Ubah</a> | <a href="">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>