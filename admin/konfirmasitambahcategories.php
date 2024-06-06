<?php 
include('../koneksi/koneksi.php');
$categories = mysqli_real_escape_string($koneksi, $_POST['categories']);
if (empty($categories)) {
    header("Location:tambahcategories.php?notif=tambahkosong");
    exit();
} else {
    $sql = "INSERT INTO `categories` (`name`) VALUES ('$categories')";
    if (mysqli_query($koneksi, $sql)) {
        header("Location:categories.php?notif=tambahberhasil");
    } else {
        header("Location:tambahcategories.php?notif=tambahgagal");
    }
}
?>
