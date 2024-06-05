<?php
$koneksi = mysqli_connect("localhost","root","","protal_news");
if (!$koneksi){
  die("Error koneksi: " . mysqli_connect_errno());
}
?>
