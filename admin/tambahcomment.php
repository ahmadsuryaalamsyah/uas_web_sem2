<?php 
include('../koneksi/koneksi.php');
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
              <h3><i class="fas fa-plus"></i> Tambah Comment</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="blog.php">Data Comment</a></li>
                <li class="breadcrumb-item active">Tambah Comment</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      
      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data Comment</h3>
            <div class="card-tools">
              <a href="comment.php" class="btn btn-sm btn-warning float-right">
              <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
            </div>
          </div><br><br>
          
          <div class="col-sm-10">
            <?php if(!empty($_GET['notif']) && !empty($_GET['jenis'])): ?>
              <?php if($_GET['notif'] == "tambahkosong"): ?>
                <div class="alert alert-danger" role="alert">
                  Maaf data <?php echo $_GET['jenis']; ?> wajib diisi
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          
          <form class="form-horizontal" action="konfirmasitambahcomment.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group col">
                <label for="article_id" class="col-sm-3 col-form-label">Judul Artikel</label>
                <select class="form-control" id="article_id" name="article_id" required>
                  <option value="">Pilih Judul Artikel</option>
                  <?php 
                  $sql_t = "SELECT `article_id`,`title` FROM `articles` ORDER BY `title` ASC";
                  $query_t = mysqli_query($koneksi, $sql_t);
                  while($data_t = mysqli_fetch_row($query_t)){
                      $article_id = $data_t[0];
                      $title = $data_t[1];
                  ?>
                  <option value="<?php echo $article_id;?>">
                    <?php echo $title;?>
                  </option>
                  <?php } ?>
                </select>
              </div>
              
              <div class="form-group col">
                <label for="isi" class="col-sm-3 col-form-label">Comment</label>
                <div class="col-sm-7">
                  <textarea class="form-control" name="isi" id="editor1" rows="12" required></textarea>
                </div>
              </div>

              <div class="form-group col">
                 <label for="author_id" class="col-sm-3 col-form-label">Penulis</label>
                 <select class="form-control" id="author_id" name="author_id" required>
                   <option value="">Pilih Penulis</option>
                   <?php 
                   $sql_u = "SELECT `user_id`,`nama` FROM `users` ORDER BY `nama` ASC";
                   $query_u = mysqli_query($koneksi, $sql_u);
                   while($data_u = mysqli_fetch_row($query_u)){
                       $id_user = $data_u[0];
                       $nama = $data_u[1];
                   ?>
                   <option value="<?php echo $id_user;?>">
                     <?php echo $nama;?>
                   </option> 
                   <?php } ?>
                 </select>
               </div>
            </div>
 
            <div class="card-footer">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info float-right"><i class="fas fa-plus"></i> Tambah</button>
              </div>  
            </div>
          </form>
        </div>
      </section>
    </div>
    
    <?php include("includes/footer.php"); ?>
  </div>
  <?php include("includes/script.php"); ?>
</body>
</html>
