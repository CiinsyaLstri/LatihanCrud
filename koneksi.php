<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "latihancrud";

$konek = mysqli_connect($host, $username, $password, $database);

if ($konek) {
    echo "Koneksi Berhasil!";
} else {
    echo "Koneksi Gagal!";
}