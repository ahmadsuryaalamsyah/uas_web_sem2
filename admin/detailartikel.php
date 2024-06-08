<?php 
session_start();
include('../koneksi/koneksi.php');
if(isset($_GET['data'])){
  $article_id = $_GET['data']; 
  $sql = "SELECT `b`.`cover`, `b`.`title`, `b`.`content`, DATE_FORMAT(`b`.`created_at`, '%d-%m-%Y') AS `create_at`, `u`.`name`
          FROM `articles` `b`
          INNER JOIN `users` `u` ON `b`.`author_id` = `u`.`user_id`
          WHERE `b`.`article_id`='$article_id'"; 

  $query = mysqli_query($koneksi, $sql);
  while($data = mysqli_fetch_assoc($query)){
    $cover = $data['cover'];
    $judul = $data['title'];
    $isi = $data['content']; 
    $create_at = $data['create_at']; 
    $nama_penulis = $data['nama'];
  }
} else {
  echo "Data tidak ditemukan.";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include("includes/header.php") ?>
    <?php include("includes/sidebar.php") ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3><i class="fas fa-user-tie"></i> Detail Data Artikel</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="artikel.php">Data Artikel</a></li>
                <li class="breadcrumb-item active">Detail Data Artikel</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <a href="artikel.php" class="btn btn-sm btn-warning float-right">
              <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td><strong>Cover Blog</strong></td>
                  <td><img src="cover/<?php echo $cover;?>" class="img-fluid" width="200px;"></td>
                </tr>               
                <tr>
                  <td width="20%"><strong>Tanggal</strong></td>
                  <td width="80%"><?php echo $create_at;?></td>
                </tr>              
                <tr>
                  <td width="20%"><strong>Judul</strong></td>
                  <td width="80%"><?php echo $judul;?></td>
                </tr>
                <tr>
                  <td width="20%"><strong>Penulis</strong></td>
                  <td width="80%"><?php echo $nama_penulis;?></td>
                </tr>
                <tr>
                  <td width="20%"><strong>Isi</strong></td>
                  <td width="80%"><?php echo $isi;?></td>
                </tr>
              </tbody>
            </table>  
          </div>
          <div class="card-footer clearfix">&nbsp;</div>
        </div>
      </section>
    </div>
    <?php include("includes/footer.php") ?>
  </div>
  <?php include("includes/script.php") ?>
</body>
</html>
