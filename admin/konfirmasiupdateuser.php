<?php
session_start();
include('../koneksi/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    if (empty($nama)) {
        $_SESSION['error_message'] = "Maaf data nama wajib di isi";
        header('Location: edituser.php?user_id=' . $user_id);
        exit;
    }

    $foto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $target_dir = 'foto/'.$nama_file;
        $target_file = $target_dir . basename($_FILES['foto']['name']);

        if (!file_exists($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                $_SESSION['error_message'] = "Maaf, terjadi kesalahan saat membuat direktori unggahan.";
                header('Location: edituser.php?user_id=' . $user_id);
                exit;
            }
        }

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $_SESSION['error_message'] = "Maaf, terjadi kesalahan saat mengunggah file.";
            header('Location: edituser.php?user_id=' . $user_id);
            exit;
        }
    } else {
        $foto = $_POST['existing_foto'];
    }

    $sql = "UPDATE `users` SET 
            `nama` = '$nama', 
            `email` = '$email', 
            `username` = '$username', 
            `role` = '$role', 
            `foto` = '$foto'";
    if ($password) {
        $sql .= ", `password` = '$password'";
    }
    $sql .= " WHERE `user_id` = '$user_id'";

    if (mysqli_query($koneksi, $sql)) {
        header('Location: user.php');
        exit;
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($koneksi);
        header('Location: edituser.php?user_id=' . $user_id);
        exit;
    }
}
?>
