<?php
$koneksi = mysqli_connect("localhost","root","","blog");
if (!$koneksi){
  die("Error koneksi: " . mysqli_connect_errno());
}
?>
