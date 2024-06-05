<?php 
session_start();
include('../koneksi/koneksi.php');
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql_d = "SELECT `nama`, `email`, `role`, `username`, `foto`,`password` FROM `users` WHERE `user_id` = '$user_id'";
    $query_d = mysqli_query($koneksi, $sql_d);
    while ($data_d = mysqli_fetch_row($query_d)) {
        $nama = $data_d[0];
        $email = $data_d[1];
        $role = $data_d[2];
        $username = $data_d[3];
        $foto = $data_d[4];
        $password = $data_d[5];
    }
  }
?>
<!DOCTYPE html>
<html>
 <head>
  <?php include("includes/head.php"); ?> 
 </head>
 <body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  <?php include("includes/header.php"); ?>
  <?php include("includes/sidebar.php"); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-user-tie"></i> Detail Data User</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="user.php">Data User</a></li>
              <li class="breadcrumb-item active">Detail Data User</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <a href="user.php" class="btn btn-sm btn-warning float-right">
            <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td colspan="2"><i class="fas fa-user-circle"></i> <strong>Data User</strong></td>
              </tr>
              <tr>
                <td><strong>Foto User</strong></td>
                <td><img src="foto/<?php echo $foto; ?>" class="img-fluid" width="200px;"></td>
              </tr>
              <tr>
                <td width="20%"><strong>Nama</strong></td>
                <td width="80%"><?php echo $nama; ?></td>
              </tr>
              <tr>
                <td width="20%"><strong>Email</strong></td>
                <td width="80%"><?php echo $email; ?></td>
              </tr>
              <tr>
                <td width="20%"><strong>Level</strong></td>
                <td width="80%"><?php echo $role; ?></td>
              </tr>
              <tr>
                <td width="20%"><strong>Username</strong></td>
                <td width="80%"><?php echo $username; ?></td>
              </tr>
              <tr>
                <td width="20%"><strong>Password</strong></td>
                <td width="80%"><?php echo $password; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer clearfix">&nbsp;</div>
      </div>
    </section>
   </div>
   <?php include("includes/footer.php"); ?>
  </div>
  <?php include("includes/script.php"); ?>
 </body>
</html>
