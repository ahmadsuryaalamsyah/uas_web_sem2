<?php 
include('../koneksi/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];
    $cover = $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];
    $target_dir = "cover/";
    $target_file = $target_dir . basename($cover);

    if (move_uploaded_file($cover_tmp, $target_file)) {
        $sql = "INSERT INTO articles (title, content, author_id, category_id, cover, created_at) 
                VALUES ('$title', '$content', '$author_id', '$category_id', '$cover', NOW())";

        if (mysqli_query($koneksi, $sql)) {
            header("Location: artikel.php?notif=tambahberhasil");
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error mengunggah file.";
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
             <h3><i class="fab fa-blogger"></i> Tambah Artikel</h3>
           </div>
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
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
             <form method="POST" action="" enctype="multipart/form-data">
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
                 <label for="tag_id">Tag</label>
                 <select class="form-control" id="tag_id" name="tag_id">
                   <?php 
                   $sql_t = "SELECT `tag_id`,`name` FROM `tags` ORDER BY `name`";
                   $query_t = mysqli_query($koneksi, $sql_t);
                   while($data_t = mysqli_fetch_row($query_t)){
                       $id_tag = $data_t[0];
                       $name = $data_t[1];
                   ?>
                   <option value="<?php echo $id_tag;?>">
                       <?php echo $name;?>
                   </option>
                   <?php } ?>
                 </select>
               </div>
               <div class="form-group">
                 <label for="author_id">Penulis</label>
                 <select class="form-control" id="author_id" name="author_id">
                   <?php 
                   $sql_u = "SELECT `user_id`,`username` FROM `users` ORDER BY `username`";
                   $query_u = mysqli_query($koneksi, $sql_u);
                   while($data_u = mysqli_fetch_row($query_u)){
                       $id_user = $data_u[0];
                       $username = $data_u[1];
                   ?>
                   <option value="<?php echo $id_user;?>">
                       <?php echo $username;?>
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
