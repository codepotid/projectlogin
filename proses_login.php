<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['nama'] = $user['nama_lengkap'];

        header("Location: user/index.php");
        exit;
    } else {
        echo "Password salah!";
    }
} else {
    echo "Email tidak terdaftar!";
}

$koneksi->close();
