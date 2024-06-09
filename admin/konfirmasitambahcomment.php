<?php
include('../koneksi/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $article_id = $_POST['article_id'];
    $isi = $_POST['isi'];
    $author_id = $_POST['author_id'];

    if (!empty($article_id) && !empty($isi) && !empty($author_id)) {
        $isi = str_replace(array('<p>', '</p>'), '', $isi);
        $isi = trim($isi);
        $sql = "INSERT INTO comments (article_id, content, user_id) VALUES ('$article_id', '$isi', '$author_id')";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            header("Location: comment.php?notif=tambahberhasil");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } 
}
?>
