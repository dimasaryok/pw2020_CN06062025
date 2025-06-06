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
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = Koneksi();
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = Koneksi();

  $id      = $data['id'];
  $nama    = htmlspecialchars($data['nama']);
  $nrp     = htmlspecialchars($data['nrp']);
  $email   = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "UPDATE mahasiswa SET
                  nama  = '$nama',
                  nrp   = '$nrp',
                  email = '$email',
                  jurusan = '$jurusan',
                  gambar = '$gambar'
                  WHERE id = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = Koneksi();

  $query = "SELECT * FROM mahasiswa WHERE 
                nama LIKE '%$keyword%' OR
                nrp LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'";

  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}
