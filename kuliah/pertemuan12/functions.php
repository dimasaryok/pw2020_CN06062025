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

function login($data)
{
  $conn = Koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // cek dulu username
  if ($user = Query("SELECT * FROM user WHERE username = '$username'")) {
    // cek password
    if (password_verify($password, $user['password'])) {
      // set session
      $_SESSION['login'] = true;

      header("location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username / Password anda salah!'
  ];
}


function registrasi($data)
{
  $conn = Koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);


  // jika username dan password kosong akan di execute sama query ini
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
        alert('username / password tidak boleh kosong!');
        document.location.href = 'registrasi.php';
        </script>";
    return false;
  }

  // jika username sudah ada
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
        alert('username sudah terdaftar!');
        document.location.href = 'registrasi.php';
        </script>";
    return false;
  }

  // jika confirmasi password tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
        alert('Konfirmasi password tidak sesuai!');
        document.location.href = 'registrasi.php';
        </script>";
    return false;
  }

  // jika password < 5 digit
  if (strlen($password1) < 5) {
    echo "<script>
        alert('Password terlalu pendek!');
        document.location.href = 'registrasi.php';
        </script>";
    return false;
  }

  // jika username dan password sudah sesuai
  // enkripsi password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);
  // inser ke tabel user
  $query = "INSERT INTO user 
            VALUES
            (null, '$username', '$password_baru')
            ";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
