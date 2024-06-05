<?php 
session_start();
include('../koneksi/koneksi.php');
if (isset($_GET['data'])) {
    $id_konten = $_GET['data'];
    $_SESSION['id_konten'] = $id_konten;
    $sql_d = "SELECT `judul`, `isi` FROM `konten` WHERE `id_konten` = '$id_konten'";
    $query_d = mysqli_query($koneksi, $sql_d);
    while ($data_d = mysqli_fetch_row($query_d)) {
        $judul = $data_d[0];
        $isi = $data_d[1];
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
    
    if (empty($judul)) {
        $error_message = "Maaf judul wajib di isi";
    } else {
        $sql_update = "UPDATE `konten` SET `judul` = '$judul', `isi` = '$isi' WHERE `id_konten` = '$_SESSION[id_konten]'";
        if (mysqli_query($koneksi, $sql_update)) {
            header('Location: konten.php');
            exit;
        } else {
            $error_message = "Error updating record: " . mysqli_error($koneksi);
        }
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
             <h3><i class="fas fa-edit"></i> Edit Data Konten</h3>
           </div>
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="konten.php">Data Konten</a></li>
               <li class="breadcrumb-item active">Edit Data Konten</li>
             </ol>
           </div>
         </div>
       </div>
     </section>
     <section class="content">
     <div class="card card-info">
       <div class="card-header">
         <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Konten</h3>
         <div class="card-tools">
           <a href="konten.php" class="btn btn-sm btn-warning float-right">
           <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
         </div>
       </div>
       </br></br>
       <?php if (isset($error_message)) { ?>
       <div class="col-sm-10">
           <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
       </div>
       <?php } ?>
       <form class="form-horizontal" action="" method="post">
         <div class="card-body">   
           <div class="form-group row">
             <label for="judul" class="col-sm-3 col-form-label">Judul</label>
             <div class="col-sm-7">
               <input type="text" class="form-control" name="judul" id="judul" value="<?php echo isset($judul) ? $judul : ''; ?>">
             </div>
           </div>
           <div class="form-group row">
             <label for="isi" class="col-sm-3 col-form-label">Isi</label>
             <div class="col-sm-7">
               <textarea class="form-control" name="isi" id="editor1" rows="12"><?php echo isset($isi) ? $isi : ''; ?></textarea>
             </div>
           </div>     
           </div>
         </div>
       </div>
         <div class="card-footer">
           <div class="col-sm-12">
             <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
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
