<?php

function Koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_043040023');
}

function Query($query)
{
  $conn = Koneksi();

  $result = mysqli_query($conn, $query);

  // Ubah isi tabel Mahasiswa
  // $row = mysqli_fetch_row($result); // array numeric
  // $row = mysqli_fetch_assoc($result); // array assosiative
  // $row = mysqli_fetch_array($result); // menampilkan array numeric dan assosiative

  $rows = []; // kurung siku menandakan Array kosong
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  } // array paling umum digunakan

  return $rows;
}
