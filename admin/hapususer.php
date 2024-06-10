<?php
session_start();
include('../koneksi/koneksi.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    if (is_numeric($user_id)) {
        $sql = "DELETE FROM `users` WHERE `user_id` = '$user_id'";
        $query = mysqli_query($koneksi, $sql);
        if ($query) {
            header("Location: user.php?notif=hapusberhasil");
        } else {
            die("Error: " . mysqli_error($koneksi));
        }
    } else {
        die("ID tidak valid.");
    }
} else {
    die("ID tidak ditemukan.");
}
?>
