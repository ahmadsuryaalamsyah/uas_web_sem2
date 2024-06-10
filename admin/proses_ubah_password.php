<?php
session_start();
include('../koneksi/koneksi.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$pass_lama = $_POST['pass_lama'];
$pass_baru = $_POST['pass_baru'];
$konfirmasi = $_POST['konfirmasi'];
$user_id = $_SESSION['user_id'];
$errors = array();

if (empty($pass_lama)) {
    $errors[] = "Password lama wajib diisi.";
}

if (empty($pass_baru)) {
    $errors[] = "Password baru wajib diisi.";
}

if (empty($konfirmasi)) {
    $errors[] = "Konfirmasi password baru wajib diisi.";
}

if ($pass_baru != $konfirmasi) {
    $errors[] = "Password baru dan konfirmasi password tidak cocok.";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ubahpassword.php");
    exit();
}

$sql = "SELECT `password` FROM `users` WHERE `user_id` = '$user_id'";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    $_SESSION['errors'] = array("Terjadi kesalahan saat mengambil data pengguna. Silakan coba lagi.");
    header("Location: ubahpassword.php");
    exit();
}

$data = mysqli_fetch_assoc($query);
$stored_password = $data['password'];

error_log("User ID: $user_id");
error_log("Entered Old Password: $pass_lama");
error_log("Stored Password: $stored_password");

if ($pass_lama !== $stored_password) {
    $_SESSION['errors'] = array("Password lama tidak sesuai.");
    header("Location: ubahpassword.php");
    exit();
}

$sql = "UPDATE `users` SET `password` = '$pass_baru' WHERE `user_id` = '$user_id'";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    $_SESSION['success'] = "Password berhasil diubah.";
    header("Location: ubahpassword.php");
} else {
    $_SESSION['errors'] = array("Terjadi kesalahan saat mengubah password. Silakan coba lagi.");
    header("Location: ubahpassword.php");
}

exit();
?>
