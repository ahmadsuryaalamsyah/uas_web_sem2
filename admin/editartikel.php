<?php
include('../koneksi/koneksi.php');
$article = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = $_POST['article_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];

    $stmt = $koneksi->prepare("UPDATE articles SET title=?, content=?, author_id=?, category_id=? WHERE article_id=?");
    $stmt->bind_param("ssiii", $title, $content, $author_id, $category_id, $article_id);

    if ($stmt->execute()) {
        header("Location: artikel.php?notif=editberhasil");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

if (isset($_GET['data'])) {
    $article_id = $_GET['data'];
    $sql = "SELECT * FROM `articles` WHERE `article_id` = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
}

$sql_k = "SELECT `category_id`,`name` FROM `categories` ORDER BY `name`";
$query_k = mysqli_query($koneksi, $sql_k);

$sql_u = "SELECT `user_id`,`username` FROM `users` ORDER BY `username`";
$query_u = mysqli_query($koneksi, $sql_u);
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
               <li class="breadcrumb-item active"> Edit Artikel</li>
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
             <form method="POST" action="" enctype="multipart/form-data">
               <input type="hidden" name="article_id" value="<?php echo isset($article['article_id']) ? $article['article_id'] : ''; ?>">
               <div class="form-group">
                 <label for="title">Judul</label>
                 <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($article['title']) ? $article['title'] : ''; ?>">
               </div>
               <div class="form-group">
                 <label for="content">Konten</label>
                 <textarea class="form-control" id="content" name="content"><?php echo isset($article['content']) ? $article['content'] : ''; ?></textarea>
               </div>
               <div class="form-group">
                 <label for="category_id">Kategori</label>
                 <select class="form-control" id="category_id" name="category_id">
                   <?php 
                   while($data_k = mysqli_fetch_assoc($query_k)){
                       $selected = ($data_k['category_id'] == $article['category_id']) ? 'selected' : '';
                   ?>
                   <option value="<?php echo $data_k['category_id']; ?>" <?php echo $selected; ?>>
                       <?php echo $data_k['name']; ?>
                   </option>
                   <?php } ?>
                 </select>
               </div>
               <div class="form-group">
                 <label for="author_id">Penulis</label>
                 <select class="form-control" id="author_id" name="author_id">
                   <?php 
                   while($data_u = mysqli_fetch_assoc($query_u)){
                       $selected = ($data_u['user_id'] == $article['author_id']) ? 'selected' : '';
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
