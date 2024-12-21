<html>
<head>
    <title>Latihan CRUD Sederhana</title>
    <link rel="stylesheet" href="update.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            }).val();
        });
    </script>
</head>

<body>
    <h3>MENAMBAHKAN DATA SISWA</h3>

    <?php
    include 'koneksi.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $perintahSql = "SELECT * FROM siswa WHERE id = $id";
        $proses = mysqli_query($konek, $perintahSql);
        $data = mysqli_fetch_array($proses);
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <input type="hidden" name="fotolama" value="<?php echo $data['foto']; ?>">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required></td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td><input type="text" name="tempat" value="<?php echo $data['tempat']; ?>" required></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="text" name="ttl" id="datepicker" value="<?php echo $data['ttl']; ?>" required></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>
                    <select name="agama" required>
                        <option>-- Pilih Agama --</option>
                        <option <?php if ($data['agama'] == 'ISLAM') echo 'selected'; ?> value="ISLAM">ISLAM</option>
                        <option <?php if ($data['agama'] == 'KRISTEN') echo 'selected'; ?> value="KRISTEN">KRISTEN</option>
                        <option <?php if ($data['agama'] == 'KATOLIK') echo 'selected'; ?> value="KATOLIK">KATOLIK</option>
                        <option <?php if ($data['agama'] == 'BUDHA') echo 'selected'; ?> value="BUDHA">BUDHA</option>
                        <option <?php if ($data['agama'] == 'HINDU') echo 'selected'; ?> value="HINDU">HINDU</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>No HP</td>
                <td><input type="number" name="no_hp" value="<?php echo $data['no_hp']; ?>" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $data['email']; ?>" required></td>
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

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tempat = $_POST['tempat'];
        $ttl = $_POST['ttl'];
        $agama = $_POST['agama'];
        $no_hp = $_POST['no_hp'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $foto = $_FILES['foto']['name'];
        $tmpFoto = $_FILES['foto']['tmp_name'];
        $namaFoto = $nama . '-' . $foto;
        $lokasiFoto = 'upload/';

        $prosesUpload = move_uploaded_file($tmpFoto, $lokasiFoto . $namaFoto);

        if ($prosesUpload) {
            unlink($lokasiFoto . $_POST['fotolama']);

            $perintahSql = "UPDATE siswa SET 
                nama='$nama', 
                alamat='$alamat', 
                tempat='$tempat', 
                ttl='$ttl', 
                agama='$agama', 
                no_hp='$no_hp', 
                email='$email', 
                password='$password', 
                foto='$namaFoto' 
                WHERE id = $id";

            $proses = mysqli_query($konek, $perintahSql);

            if ($proses) {
                header('location:index.php');
            } else {
                echo "<script>alert('Gagal Disimpan')</script>";
            }
        } else {
            echo "<script>alert('Gagal Upload Foto')</script>";
        }
    }
    ?>
</body>
</html>