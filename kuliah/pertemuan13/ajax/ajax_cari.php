<?php
require '../functions.php';
$mahasiswa = cari($_GET['keyword']);

?>

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