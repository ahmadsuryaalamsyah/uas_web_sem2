<?php 
session_start();
include('../koneksi/koneksi.php');
if(isset($_SESSION['category_id'])){
  $category_id = $_SESSION['category_id'];
  $name = $_POST['name'];
 
   if(empty($name)){
       header("Location:editcategories.php?data=".$category_id."&notif=editkosong");
  }else{
	$sql = "update `categories` set `name`='$name' where `category_id`='$category_id'";
	mysqli_query($koneksi,$sql);
	unset($_SESSION['category_id']);
	header("Location:categories.php?notif=editberhasil");
  }
}
?>
