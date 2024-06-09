<?php
session_start();
include('../koneksi/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($nama)) {
        $_SESSION['error_message'] = "Maaf data nama wajib di isi";
        header('Location: tambahuser.php');
        exit;
    }

    $foto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $target_dir = 'foto/';
        $target_file = $target_dir . basename($foto);

        if (!file_exists($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                $_SESSION['error_message'] = "Maaf, terjadi kesalahan saat membuat direktori upload.";
                header('Location: tambahuser.php');
                exit;
            }
        }

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $_SESSION['error_message'] = "Maaf, terjadi kesalahan saat mengupload file.";
            header('Location: tambahuser.php');
            exit;
        }
    }

    $sql = "INSERT INTO `users` (`nama`, `email`, `username`, `password`, `role`, `foto`) VALUES ('$nama', '$email', '$username', '$password', '$role', '$foto')";
    if (mysqli_query($koneksi, $sql)) {
        header('Location: user.php');
        exit;
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($koneksi);
        header('Location: tambahuser.php');
        exit;
    }
}
?>
