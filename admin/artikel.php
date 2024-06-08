<?php 
include('../koneksi/koneksi.php');
if((isset($_GET['aksi']))&&(isset($_GET['data']))){
  if($_GET['aksi']=='hapus'){
     $article_id = $_GET['data'];
     $sql_f = "SELECT `cover` FROM `articles` WHERE `article_id`='$article_id'";
     $query_f = mysqli_query($koneksi,$sql_f);
     if($query_f) {
        $jumlah_f = mysqli_num_rows($query_f);
        if($jumlah_f > 0){
          while($data_f = mysqli_fetch_row($query_f)){
            $cover = $data_f[0];
            if (file_exists("cover/$cover")) {
              unlink("cover/$cover");
            }
          }
        }
     }
   $sql_dh = "DELETE FROM `tag_articles` WHERE `article_id` = '$article_id'";
   mysqli_query($koneksi,$sql_dh);
   $sql_dm = "DELETE FROM `articles` WHERE `article_id` = '$article_id'";
   mysqli_query($koneksi,$sql_dm);
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
             <h3><i class="fab fa-blogger"></i> Artikel</h3>
           </div>
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item active"> Artikel</li>
             </ol>
           </div>
         </div>
       </div>
     </section>

     <section class="content">
             <div class="card">
               <div class="card-header">
                 <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Artikel</h3>
                 <div class="card-tools">
                   <a href="tambahartikel.php" class="btn btn-sm btn-info float-right">
                   <i class="fas fa-plus"></i> Tambah Artikel</a>
                 </div>
               </div>

               <div class="card-body">
               <div class="col-md-12">
                   <form method="get" action="artikel.php">
                     <div class="row">
                         <div class="col-md-4 bottom-10">
                           <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                         </div>
                         <div class="col-md-5 bottom-10">
                           <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                         </div>
                     </div>
                   </form>
                 </div><br>
               <div class="col-sm-12">
               <?php if(!empty($_GET['notif'])){?>
                       <?php if($_GET['notif']=="tambahberhasil"){?>
                           <div class="alert alert-success" role="alert">
                               Data Berhasil Ditambahkan</div>
                       <?php } else if($_GET['notif']=="editberhasil"){?>
                           <div class="alert alert-success" role="alert">
                               Data Berhasil Diubah</div>
                       <?php } else if($_GET['notif']=="hapusberhasil"){?>
                           <div class="alert alert-success" role="alert">
                               Data Berhasil Dihapus</div>
                       <?php } ?>
                   <?php }?>
               </div>
               <table class="table table-bordered">
                     <thead>                  
                       <tr>
                         <th width="5%">No</th>
                         <th width="30%">Kategori</th>
                         <th width="30%">Judul</th>
                         <th width="20%">Tanggal</th>
                         <th width="15%"><center>Aksi</center></th>
                       </tr>
                     </thead>
                     <tbody>
                     <?php 
                     $batas = 4;
                     if(!isset($_GET['halaman'])){
                          $posisi = 0;
                          $halaman = 1;
                     }else{
                          $halaman = $_GET['halaman'];
                          $posisi = ($halaman-1) * $batas;
                     } 
                     $sql_b = "SELECT `a`.`article_id`, `a`.`title`, `c`.`name`, DATE_FORMAT(`a`.`created_at`, '%d-%m-%Y'), `a`.`cover` 
                     FROM `articles` `a`
                     INNER JOIN `categories` `c` 
                     ON `a`.`category_id` = `c`.`category_id`";
                     if (isset($_GET["katakunci"])) {
                       $katakunci_kategori = $_GET["katakunci"];
                       $sql_b .= " WHERE `a`.`title` LIKE '%$katakunci_kategori%' OR `c`.`name` LIKE '%$katakunci_kategori%'";
                   }                 
                     $sql_b .= " ORDER BY `c`.`name`, `a`.`title` LIMIT $posisi, $batas";
                     $query_b = mysqli_query($koneksi,$sql_b);
                     if(!$query_b){
                         echo "Error: " . mysqli_error($koneksi);
                         die();
                     }
                     $no = $posisi+1;
                     while($data_b = mysqli_fetch_row($query_b)){
                         $article_id = $data_b[0];
                         $title = $data_b[1];
                         $name = $data_b[2];
                         $created_at = $data_b[3];
                         $cover = $data_b[4];
                     ?>
                       <tr>
                         <td><?php echo $no;?></td>
                         <td><?php echo $name;?></td>
                         <td><?php echo $title;?></td>
                         <td><?php echo $created_at;?></td>
                         <td align="center">
                         <a href="editartikel.php?data=<?php echo $article_id;?>"  
                         class="btn btn-xs btn-info" title="Edit">
                         <i class="fas fa-edit"></i></a>
                       <a href="detailartikel.php?data=<?php echo $article_id;?>" 
                         class="btn btn-xs btn-info" title="Detail">
                         <i class="fas fa-eye"></i></a>
                         <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $title; ?>?')) 
                         window.location.href = 'artikel.php?aksi=hapus&data=<?php echo $article_id;?>&notif=hapusberhasil'" 
                         class="btn btn-xs btn-warning">
                         <i class="fas fa-trash" title="Hapus">
                         </i></a>                         
                         </td>
                       </tr>
                     <?php $no++;}?>
                     </tbody>
                   </table>  
               </div>
               
               <?php
               $sql_jum = "SELECT `a`.`article_id`, `a`.`title`, `c`.`name`, DATE_FORMAT(`a`.`created_at`, '%d-%m-%Y')
               FROM `articles` `a`
               INNER JOIN `categories` `c`
               ON `a`.`category_id` = `c`.`category_id`";
               if (isset($_GET["katakunci"])){
                 $katakunci_kategori = $_GET["katakunci"];
                 $sql_jum .= " WHERE `c`.`name` LIKE '%$katakunci_kategori%' OR `a`.`title` LIKE '%$katakunci_kategori%'";
               }
               $sql_jum .= " ORDER BY `c`.`name`, `a`.`title`";              
               $sql_jum = mysqli_query($koneksi,$sql_jum);
               if(!$sql_jum){
                   echo "Error: " . mysqli_error($koneksi);
                   die();
               }
               $jum_data = mysqli_num_rows($sql_jum);
               $jum_halaman = ceil($jum_data/$batas);
               ?>
               <div class="card-footer clearfix">
                 <ul class="pagination pagination-sm m-0 float-right">
                 <?php 
                 if($jum_halaman==0){
                 //tidak ada halaman
                 }else if($jum_halaman==1){
                  echo "<li class='page-item'><a class='page-link'>1</a></li>";
                 }else{
                  $sebelum = $halaman-1;
                  $setelah = $halaman+1;
                  if($halaman!=1){
                 echo "<li class='page-item'>
                 <a class='page-link' href='artikel.php?halaman=1'>First</a></li>";
                 echo "<li class='page-item'>
                 <a class='page-link' href='artikel.php?halaman=$sebelum'>«</a></li>";
                  }
                for($i=1; $i<=$jum_halaman; $i++){
                    if($i>$halaman-5 and $i<$halaman+5){
                        if($i!=$halaman){
                            echo "<li class='page-item'><a class='page-link' 
                            href='artikel.php?halaman=$i'>$i</a></li>";
                        }else{
                            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                        }
                    }
                 }
                 if($halaman!=$jum_halaman){
                 echo "<li class='page-item'>
                 <a class='page-link' href='artikel.php?halaman=$setelah'>»</a></li>";
                 echo "<li class='page-item'>
                 <a class='page-link' href='artikel.php?halaman=$jum_halaman'>Last</a></li>";
                 }
               }
               ?>
                 </ul>
               </div>
             </div>
     </section>
   </div>
    <?php include("includes/footer.php") ?>
   </div>
  <?php include("includes/script.php") ?>
 </body>
</html>
