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
              <h3><i class="fas fa-plus"></i> Tambah Category</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="categories.php">Category</a></li>
                <li class="breadcrumb-item active">Tambah Category</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      
      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Category</h3>
            <div class="card-tools">
              <a href="categories.php" class="btn btn-sm btn-warning float-right">
                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
              </a>
            </div>
          </div>
          <br>
          
          <div class="col-sm-10">
            <?php if (!empty($_GET['notif'])): ?>
              <?php if ($_GET['notif'] == "tambahkosong"): ?>
                <div class="alert alert-danger" role="alert">Maaf, data Category wajib diisi</div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          
          <form class="form-horizontal" method="post" action="konfirmasitambahcategories.php">
            <div class="card-body">
              <div class="form-group row">
                <label for="categories" class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="categories" name="categories" required>
                </div>
              </div>
            </div>
            
            <div class="card-footer">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-info float-right"><i class="fas fa-plus"></i> Tambah</button>
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
