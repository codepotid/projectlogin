<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sqlCekEmail = "SELECT * FROM user WHERE email = '$email'";
$result = $koneksi->query($sqlCekEmail);

if ($result->num_rows > 0) {
    echo "Email sudah terdaftar. Silakan gunakan email lain.";
} else {
    $sql = "INSERT INTO user (nama_lengkap, email, password) VALUES ('$nama','$email', '$hashedPassword')";
    if ($koneksi->query($sql) === TRUE) {
        echo "Registrasi berhasil. Silakan login.";
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
