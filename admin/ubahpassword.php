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
            <h3><i class="fas fa-user-lock"></i> Ubah Password</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Ubah Password</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Pengaturan Password</h3>
      </div>
      <form class="form-horizontal" method="post" action="proses_ubah_password.php">
        <div class="card-body">
          <h6>
            <i class="text-blue"><i class="fas fa-info-circle"></i> Silahkan memasukkan password lama dan password baru Anda untuk mengubah password.</i>
          </h6><br>
          
          <div class="form-group row">
            <label for="pass_lama" class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="pass_lama" name="pass_lama" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="pass_baru" class="col-sm-3 col-form-label">Password Baru</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="pass_baru" name="pass_baru" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="konfirmasi" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" value="">
              <span class="text-danger">Mohon maaf, konfirmasi password baru wajib diisi.</span>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
          </div>  
         </div>
        </form>
       </div>
      </section>
     </div>
    <?php include("includes/footer.php") ?>
   </div>
  <?php include("includes/script.php") ?>
 </body>
</html>
