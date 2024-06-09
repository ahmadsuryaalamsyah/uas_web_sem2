<?php 
include('../koneksi/koneksi.php');

if((isset($_GET['aksi'])) && (isset($_GET['data']))){
  if($_GET['aksi'] == 'hapus'){
    $comment_id = $_GET['data'];
    $sql_f = "SELECT `content` FROM `comments` WHERE `comment_id`='$comment_id'";
    $query_f = mysqli_query($koneksi, $sql_f);
    $jumlah_f = mysqli_num_rows($query_f);
   
    $sql_dh = "DELETE FROM `comment_id` WHERE `comment_id` = '$comment_id'";
    mysqli_query($koneksi, $sql_dh);

    $sql_dm = "DELETE FROM `comment_id` WHERE `comment_id` = '$comment_id'";
    mysqli_query($koneksi, $sql_dm);
    header("Location:comment.php?notif=hapusberhasil");
    exit();
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
             <h3><i class="fas fa-file-alt"></i> Comment</h3>
           </div>
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item active"> Comment</li>
             </ol>
           </div>
         </div>
       </div>
     </section>
 
     <section class="content">
       <div class="card">
         <div class="card-header">
           <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Comment</h3>
           <div class="card-tools">
             <a href="tambahcomment.php" class="btn btn-sm btn-info float-right">
               <i class="fas fa-plus"></i> Tambah Comment
             </a>
           </div>
         </div>
         <div class="card-body">
           <div class="col-md-12">
             <form method="get" action="">
               <div class="row">
                 <div class="col-md-4 bottom-10">
                   <input type="text" class="form-control" id="kata_kunci" name="katakunci" value="<?php echo isset($_GET['katakunci']) ? $_GET['katakunci'] : ''; ?>">
                 </div>
                 <div class="col-md-5 bottom-10">
                   <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                 </div>
               </div>
             </form>
           </div><br>
           <div class="col-sm-12">
           <?php if(!empty($_GET['notif'])): ?>
             <?php if($_GET['notif'] == "tambahberhasil"): ?>
               <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
             <?php elseif($_GET['notif'] == "editberhasil"): ?>
               <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
             <?php elseif($_GET['notif'] == "hapusberhasil"): ?>
               <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
             <?php endif; ?>
           <?php endif; ?>
           </div>
           <table class="table table-bordered">
             <thead>
               <tr>
                 <th width="5%">No</th>
                 <th width="30%">Comment</th>
                 <th width="15%">ID Artikel</th>
                 <th width="15%">ID User</th>
                 <th width="30%">Tanggal</th>
               </tr>
             </thead>
             <tbody>
               <?php 
                 $batas = 5;
                 $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                 $posisi = ($halaman - 1) * $batas;
 
                 $sql_b = "SELECT `c` . `comment_id`, `c` . `content`,`a` . `article_id`, `u` . `user_id`, `c` . `created_at` FROM `comments` `c`
                 INNER JOIN `articles` `a` ON  `c`.`article_id` = `a`.`article_id`" 
                 . " INNER JOIN `users` `u` ON  `c`.`user_id` = `u`.`user_id`";
                 if (isset($_GET['katakunci'])) {
                   $katakunci_kategori = $_GET['katakunci'];
                   $sql_b .= " WHERE `content` LIKE '%$katakunci_kategori%'";
                 }
                 $sql_b .= " ORDER BY `content` LIMIT $posisi, $batas";
                 $query_b = mysqli_query($koneksi, $sql_b);
 
                 if(!$query_b){
                   die("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                 }
 
                 $no = $posisi + 1;
                 while($data_b = mysqli_fetch_row($query_b)){
                   $comment_id = $data_b[0];
                   $content = $data_b[1];
                   $atrikel_id = $data_b[2];
                   $user_id = $data_b[3];
                   $created_at = $data_b[4];

               ?>
                 <tr>
                   <td><?php echo $no; ?></td>
                   <td><?php echo $content; ?></td>
                   <td><?php echo $atrikel_id; ?></td>
                   <td><?php echo $user_id; ?></td>
                   <td><?php echo $created_at; ?></td>
                 </tr>
               <?php $no++; } ?>
             </tbody>
           </table>
         </div>
         <?php
           $sql_jum = "SELECT `comment_id`, `content` FROM `comments`";
           if (isset($_GET['katakunci'])){
             $katakunci_kategori = $_GET['katakunci'];
             $sql_jum .= " WHERE `content` LIKE '%$katakunci_kategori%'";
           }
           $query_jum = mysqli_query($koneksi, $sql_jum);
           $jum_data = mysqli_num_rows($query_jum);
           $jum_halaman = ceil($jum_data / $batas);
         ?>
         <div class="card-footer clearfix">
           <ul class="pagination pagination-sm m-0 float-right">
             <?php 
               if($jum_halaman > 1){
                 $sebelum = $halaman - 1;
                 $setelah = $halaman + 1;
                 if($halaman > 1){
                   echo "<li class='page-item'><a class='page-link' href='comment.php?halaman=1'>First</a></li>";
                   echo "<li class='page-item'><a class='page-link' href='comment.php?halaman=$sebelum'>«</a></li>";
                 }
                 for($i = 1; $i <= $jum_halaman; $i++){
                   if($i != $halaman){
                     echo "<li class='page-item'><a class='page-link' href='comment.php?halaman=$i'>$i</a></li>";
                   } else {
                     echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                   }
                 }
                 if($halaman < $jum_halaman){
                   echo "<li class='page-item'><a class='page-link' href='comment.php?halaman=$setelah'>»</a></li>";
                   echo "<li class='page-item'><a class='page-link' href='comment.php?halaman=$jum_halaman'>Last</a></li>";
                 }
               }
             ?>
           </ul>
         </div>
       </div>
     </section>
   </div>
    <?php include("includes/footer.php"); ?>
   </div>
  <?php include("includes/script.php"); ?>
 </body>
</html>
 