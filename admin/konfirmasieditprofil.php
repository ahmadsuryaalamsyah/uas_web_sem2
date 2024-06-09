<?php 
session_start();
include('../koneksi/koneksi.php');
if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
    $sql_f = "SELECT `foto` FROM `users` WHERE `user_id`='$user_id'";
    $query_f = mysqli_query($koneksi,$sql_f);
    while($data_f = mysqli_fetch_row($query_f)){
        $foto = $data_f[0];
    }
 
	if(empty($nama)){
	    header("Location:editprofil.php?notif=editkosong&jenis=nama");
	}else if(empty($email)){
	    header("Location:editprofil.php?notif=editkosong&jenis=email");
	}else{
        $lokasi_file = $_FILES['foto']['tmp_name'];
		$nama_file = $_FILES['foto']['name'];
		$direktori = 'foto/'.$nama_file;
		if(move_uploaded_file($lokasi_file,$direktori)){
            	   if(!empty($foto)){
                     unlink("foto/$foto");
                  }
		   $sql = "update `users` set `nama`='$nama', 
                  `email`='$email', `foto`='$nama_file' 
                  where `user_id`='$user_id'";
		   mysqli_query($koneksi,$sql);
		}else{
		   $sql = "update `users` set `nama`='$nama', `email`='$email' 
                  where `user_id`='$user_id'";
		   mysqli_query($koneksi,$sql);
		}
      	    header("Location:profil.php?notif=editberhasil");
	}
}
 
?>
