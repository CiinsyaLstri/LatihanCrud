<?php
session_start();
?>
<html>

<head>
    <title> Latihan CRUD Sederhana </title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
    <h3>FROM DATA SISWA</h3>

    <?php
    if (isset($_SESSION['login'])) {
        echo "<h3>Selamat Datang" . $_SESSION['login'] . "</h3>";
    }
    ?>

    <h4><a href="create.php">Tambah Data</a></h4>
    
    <?php
    if (isset($_SESSION['login'])) {
        echo "<h4><a href='logout.php'>Logout</a></h4>";
    } else {
        echo "<h4><a href='login.php'>Login</a></h4>";
    }
    ?>


    <table border=1>
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Alamat</td>
                <td>Tempat</td>
                <td>Tanggal Lahir</td>
                <td>Agama</td>
                <td>No HP</td>
                <td>Email</td>
                <td>Foto</td>
                <td>Aksi</td>
            </tr>
        </thead>

        <?php
            include 'koneksi.php';

            $perintahSql = "SELECT * FROM siswa";

            $hasil = mysqli_query($konek, $perintahSql);
            
            $no = 0;

            while($data = mysqli_fetch_array($hasil)) {
                $no++;
            ?>
            <tbody>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php echo $data['tempat']; ?></td>
                    <td><?php echo $data['ttl']; ?></td>
                    <td><?php echo $data['agama']; ?></td>
                    <td><?php echo $data['no_hp']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><img height="120px" src="<?php echo 'upload/' . $data['foto']; ?>"></td>
                    <td>
                        <a href="update.php?id=<?php echo $data['id']; ?> ">Update</a>
                        <a href="delete.php?id=<?php echo $data['id']; ?> ">Delete</a>
                    </td>
                </tr>
            </tbody>
            <?php
            }
        ?>
    </table>
</body>

</html>