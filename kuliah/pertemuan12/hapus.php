<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("location: login.php");
  exit;
}

require 'functions.php';

// jika tidak ada data yang diubah
if (!isset($_GET['id'])) {
  header("location: index.php");
  exit;
}

// mengambil data id dari URL
$id = $_GET['id'];

if (hapus($id) > 0) {
  echo "<script>
            alert('data berhasil dihapuskan');
            document.location.href = 'index.php';
          </script>";
} else {
  echo "data gagal dihapuskan!";
}
