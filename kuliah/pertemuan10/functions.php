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

  // jika hasilnya hanya 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = []; // kurung siku menandakan Array kosong
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  } // array paling umum digunakan

  return $rows;
}

function tambah($data)
{
  $conn = Koneksi();

  $nama    = htmlspecialchars($data['nama']);
  $nrp     = htmlspecialchars($data['nrp']);
  $email   = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "INSERT INTO mahasiswa
          VALUES (null, '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}
