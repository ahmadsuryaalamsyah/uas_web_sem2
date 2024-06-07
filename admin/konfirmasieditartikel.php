<?php
session_start();
include('../koneksi/koneksi.php');

if (isset($_SESSION['article_id'])) {
    $article_id = $_SESSION['article_id'];
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_POST['author_id'];
    $cover = $_FILES['cover']['name'];

    $sql_f = "SELECT `cover` FROM `articles` WHERE `article_id`='$article_id'";
    $query_f = mysqli_query($koneksi, $sql_f);
    $data_f = mysqli_fetch_assoc($query_f);
    $current_cover = $data_f['cover'];

    if (empty($category_id)) {
        header("Location:editartikel.php?data=$article_id&notif=editkosong&jenis=category");
        exit();
    } elseif (empty($title)) {
        header("Location:editartikel.php?data=$article_id&notif=editkosong&jenis=title");
        exit();
    } elseif (empty($content)) {
        header("Location:editartikel.php?data=$article_id&notif=editkosong&jenis=content");
        exit();
    } else {
        if (!empty($cover)) {
            $target_dir = "./cover/";
            $target_file = $target_dir . basename($cover);
            if (move_uploaded_file($_FILES['cover']['tmp_name'], $target_file)) {
                if (!empty($current_cover)) {
                    unlink("./cover/$current_cover");
                }
                $sql = "UPDATE `articles` SET 
                        `category_id`='$category_id', 
                        `title`='$title', 
                        `content`='$content', 
                        `author_id`='$author_id', 
                        `cover`='$cover' 
                        WHERE `article_id`='$article_id'";
                mysqli_query($koneksi, $sql);
            } else {
                echo "File upload gagal.";
                exit();
            }
        } else {
            $sql = "UPDATE `articles` SET 
                    `category_id`='$category_id', 
                    `title`='$title', 
                    `content`='$content', 
                    `author_id`='$author_id' 
                    WHERE `article_id`='$article_id'";
            mysqli_query($koneksi, $sql);
        }

        header("Location:artikel.php?notif=editberhasil");
        exit();
    }
} else {
    echo "Sesi artikel tidak ditemukan.";
    exit();
}
?>
