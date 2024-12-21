<html>
<head>
    <title>Login Siswa</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <h3>LOGIN SISWA</h3>

    <form method="post">
        <table>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td><input type="submit" value="Simpan" name="submit"></td>
                <td><input type="reset" value="Reset"></td>
            </tr>
        </table>
    </form>

    <?php
    include 'koneksi.php'; 

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']); 

        $perintahSql = "SELECT * FROM siswa WHERE email = '$email' AND password = '$password'";

        $proses = mysqli_query($konek, $perintahSql); 

        if ($proses && mysqli_num_rows($proses) > 0) {
            $data = mysqli_fetch_array($proses);

            session_start();
            $_SESSION['login'] = $data['nama'];
            header('Location: index.php'); 
            exit();
        } else {
            echo "<script>alert('Gagal Login');</script>";
        }
    }
    ?>
</body>
</html>