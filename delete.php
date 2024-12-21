<?php
include 'koneksi.php';

if(isset($_GET['id'])) { 
    $id = $_GET['id'];

    $ambilFoto = mysqli_query($konek, "SELECT foto FROM siswa WHERE id = $id");

    if ($dataFoto = mysqli_fetch_array($ambilFoto)) {

        unlink('upload/' . $dataFoto['foto']);

        $perintahSql = "DELETE FROM siswa WHERE id = $id";
        $proses = mysqli_query($konek, $perintahSql);

        if($proses) {
            header('Location:index.php');
        } else {
            echo "<script>alert('Gagal Dihapus')</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan')</script>";
    }
}
?>