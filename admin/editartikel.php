<?php
session_start();
include('../koneksi/koneksi.php');

if (isset($_GET['data'])) {
    $article_id = $_GET['data'];
    $_SESSION['article_id'] = $article_id;

    $sql_m = "SELECT `category_id`, `title`, `content`, `cover`, `author_id`, DATE_FORMAT(`created_at`, '%d-%m-%Y')
              FROM `articles` WHERE `article_id` = '$article_id'";
    $query_m = mysqli_query($koneksi, $sql_m);
    while ($data_m = mysqli_fetch_row($query_m)) {
        $category_id = $data_m[0];
        $title = $data_m[1];
        $content = $data_m[2];
        $cover = $data_m[3];
        $author_id = $data_m[4];
        $created_at = $data_m[5];
    }
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
           <h3><i class="fab fa-blogger"></i> Edit Artikel</h3>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item active">Edit Artikel</li>
           </ol>
         </div>
       </div>
     </div>
   </section>

   <section class="content">
       <div class="card">
         <div class="card-header">
           <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Form Edit Artikel</h3>
         </div>
         <div class="card-body">
           <form method="POST" action="konfirmasieditartikel.php" enctype="multipart/form-data">
             <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
             <div class="form-group">
               <label for="title">Judul</label>
               <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
             </div>
             <div class="form-group">
                <label for="cover">Cover</label>
                 <div class="custom-file">
                   <input type="file" class="custom-file-input" name="cover" id="customFile">
                   <label class="custom-file-label" for="customFile">Choose file</label>
                 </div> 
             </div>
             <div class="form-group">
               <label for="content">Konten</label>
               <textarea class="form-control" id="content" name="content"><?php echo $content; ?></textarea>
             </div>
             <div class="form-group">
               <label for="category_id">Kategori</label>
               <select class="form-control" id="category_id" name="category_id">
               <?php 
               $sql_k = "SELECT `category_id`, `name` FROM `categories` ORDER BY `name`";
               $query_k = mysqli_query($koneksi, $sql_k);
               while ($data_k = mysqli_fetch_row($query_k)) {
                   $id_kat = $data_k[0];
                   $name = $data_k[1];
               ?>
                 <option value="<?php echo $id_kat;?>" 
                 <?php if ($category_id == $id_kat) {?>selected<?php }?>>      
                 <?php echo $name;?></option>
               <?php }?>
               </select>
             </div>
             <div class="form-group">
               <label for="author_id">Penulis</label>
               <select class="form-control" id="author_id" name="author_id">
                 <?php 
                 $sql_u = "SELECT `user_id`, `username` FROM `users` ORDER BY `username`";
                 $query_u = mysqli_query($koneksi, $sql_u);
                 while ($data_u = mysqli_fetch_assoc($query_u)) {
                     $selected = ($data_u['user_id'] == $author_id) ? 'selected' : '';
                 ?>
                 <option value="<?php echo $data_u['user_id']; ?>" <?php echo $selected; ?>>
                     <?php echo $data_u['username']; ?>
                 </option>
                 <?php } ?>
               </select>
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
