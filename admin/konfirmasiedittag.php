<?php 
session_start();
include('../koneksi/koneksi.php');
if(isset($_SESSION['tag_id'])){
  $tag_id = $_SESSION['tag_id'];
  $tag = $_POST['tag'];
 
   if(empty($tag)){
       header("Location:edittag.php?data=".$tag_id."&notif=editkosong");
  }else{
	$sql = "update `tags` set `name`='$tag' where `tag_id`='$tag_id'";
	mysqli_query($koneksi,$sql);
	unset($_SESSION['tag_id']);
	header("Location:tag.php?notif=editberhasil");
  }
}
?>
