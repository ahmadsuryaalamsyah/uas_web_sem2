<?php 
include('../koneksi/koneksi.php');
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
             <h3><i class="fab fa-blogger"></i> Tambah Artikel</h3>
           </div>
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active"> Tambah Artikel</li>
             </ol>
           </div>
         </div>
       </div>
     </section>

     <section class="content">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Form Tambah Artikel</h3>
           </div>
           <div class="card-body">
             <form method="POST" action="konfirmasitambahartikel.php" enctype="multipart/form-data">
               <div class="form-group">
                 <label for="title">Judul</label>
                 <input type="text" class="form-control" id="title" name="title">
               </div>
               <div class="form-group">
                 <label for="content">Konten</label>
                 <textarea class="form-control" id="content" name="content"></textarea>
               </div>
               <div class="form-group">
                 <label for="category_id">Category</label>
                 <select class="form-control" id="category_id" name="category_id">
                   <?php 
                   $sql_k = "SELECT `category_id`,`name` FROM `categories` ORDER BY `name`";
                   $query_k = mysqli_query($koneksi, $sql_k);
                   while($data_k = mysqli_fetch_row($query_k)){
                       $id_cat = $data_k[0];
                       $name = $data_k[1];
                   ?>
                   <option value="<?php echo $id_cat;?>">
                       <?php echo $name;?>
                   </option>
                   <?php } ?>
                 </select>
               </div>
               <div class="form-group">
                 <label for="author_id">Penulis</label>
                 <select class="form-control" id="author_id" name="author_id">
                   <?php 
                   $sql_u = "SELECT `user_id`,`nama` FROM `users` ORDER BY `nama`";
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
               <div class="form-group">
                 <label for="cover">Cover</label>
                 <input type="file" class="form-control" id="cover" name="cover">
               </div>
               <button type="submit" class="btn btn-primary">Simpan</button>
             </form>
           </div>
         </div>
     </section>
   </div>
   <?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
