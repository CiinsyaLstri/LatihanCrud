<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tempat = $_POST['tempat'];
    $ttl = $_POST['ttl'];
    $agama = $_POST['agama'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';
    $tmpFoto = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : '';

    $namaFoto = $foto ? $nama . '-' . $foto : '';
    $lokasiFoto = 'upload/';

    if ($foto && move_uploaded_file($tmpFoto, $lokasiFoto . $namaFoto)) {
        $perintahSql = "INSERT INTO siswa (nama, alamat, tempat, ttl, agama, no_hp, email, foto) 
        VALUES ('$nama', '$alamat', '$tempat', '$ttl', '$agama', '$no_hp', '$email', '$namaFoto')";

        if ($konek) {
            $proses = mysqli_query($konek, $perintahSql);
            if ($proses) {
                header('Location: index.php');
            } else {
                echo "<script>alert('Gagal Disimpan')</script>";
            }
        } else {
            echo "<script>alert('Koneksi database gagal')</script>";
        }
    } else {
        echo "<script>alert('Gagal upload foto')</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Data Siswa</title>
    <link rel="stylesheet" type="text/css" href="create.css">
</head>

<body>
    <h3>MENAMBAHKAN DATA SISWA</h3>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" required></td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td><input type="text" name="tempat" required></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="text" name="ttl" id="datepicker" required></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>
                    <select name="agama" required>
                        <option value="">-- Pilih Agama --</option>
                        <option value="ISLAM">ISLAM</option>
                        <option value="KRISTEN">KRISTEN</option>
                        <option value="KATOLIK">KATOLIK</option>
                        <option value="BUDHA">BUDHA</option>
                        <option value="HINDU">HINDU</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>No HP</td>
                <td><input type="number" name="no_hp" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><input type="file" name="foto" required></td>
            </tr>
            <tr>
                <td><input type="submit" value="Simpan" name="submit"></td>
                <td><input type="reset" value="Reset"></td>
            </tr>
        </table>
    </form>
</body>

</html>
