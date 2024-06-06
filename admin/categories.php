<?php 
session_start();
include('../koneksi/koneksi.php');

if (isset($_GET['aksi']) && isset($_GET['data'])) {
    if ($_GET['aksi'] == 'hapus') {
        $category_id = $_GET['data'];
        $sql_dh = "DELETE FROM `categories` WHERE `category_id` = '$category_id'";
        mysqli_query($koneksi, $sql_dh);
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
              <h3><i class="fas fa-address-book"></i>Category</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> Category</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Category</h3>
            <div class="card-tools">
              <a href="tambahcategories.php" class="btn btn-sm btn-info float-right">
                <i class="fas fa-plus"></i>Tambah Category
              </a>
            </div>
          </div>
          
          <div class="card-body">
            <div class="col-md-12">
              <form method="get" action="categories.php">
                <div class="row">
                  <div class="col-md-4 bottom-10">
                    <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                  </div>
                  <div class="col-md-5 bottom-10">
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-search"></i>&nbsp; Search
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <br>
            <div class="col-sm-12">
              <?php if (!empty($_GET['notif'])): ?>
                <div class="alert alert-success" role="alert">
                  <?php 
                    if ($_GET['notif'] == "tambahberhasil") {
                      echo "Data Berhasil Ditambahkan";
                    } elseif ($_GET['notif'] == "editberhasil") {
                      echo "Data Berhasil Diubah";
                    } elseif ($_GET['notif'] == "hapusberhasil") {
                      echo "Data Berhasil Dihapus";
                    }
                  ?>
                </div>
              <?php endif; ?>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="80%">Category</th>
                  <th width="15%"><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $batas = 4;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $posisi = ($halaman - 1) * $batas;

                $sql_k = "SELECT `category_id`, `name` FROM `categories`";
                if (isset($_GET["katakunci"])) {
                  $katakunci_kategori = mysqli_real_escape_string($koneksi, $_GET["katakunci"]);
                  $sql_k .= " WHERE `name` LIKE '%$katakunci_kategori%'";
                }                
                $sql_k .= " ORDER BY `name` LIMIT $posisi, $batas";
                $query_k = mysqli_query($koneksi, $sql_k);
                $no = $posisi + 1;

                while ($data_k = mysqli_fetch_row($query_k)) {
                  $category_id = $data_k[0];
                  $category_name = $data_k[1];
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $category_name; ?></td>
                    <td align="center">
                      <a href="editcategories.php?data=<?php echo $category_id; ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                      <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $category_name; ?>?'))window.location.href = 'categories.php?aksi=hapus&data=<?php echo $category_id; ?>&notif=hapusberhasil'" class="btn btn-xs btn-warning"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                  </tr>
                <?php 
                  $no++;
                } 
                ?>
              </tbody>
            </table>
          </div>
          <?php
          $sql_jum = "SELECT COUNT(*) FROM `categories`";
          if (isset($_GET["katakunci"])) {
            $katakunci_kategori = mysqli_real_escape_string($koneksi, $_GET["katakunci"]);
            $sql_jum .= " WHERE `name` LIKE '%$katakunci_kategori%'";
          }
          $query_jum = mysqli_query($koneksi, $sql_jum);
          $jum_data = mysqli_fetch_row($query_jum)[0];
          $jum_halaman = ceil($jum_data / $batas);
          ?>
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <?php 
              if ($jum_halaman > 1) {
                $sebelum = $halaman - 1;
                $setelah = $halaman + 1;
                $url_katakunci = isset($_GET["katakunci"]) ? "&katakunci=".$_GET["katakunci"] : "";

                if ($halaman > 1) {
                  echo "<li class='page-item'><a class='page-link' href='categories.php?halaman=1$url_katakunci'>First</a></li>";
                  echo "<li class='page-item'><a class='page-link' href='categories.php?halaman=$sebelum$url_katakunci'>«</a></li>";
                }
                for ($i = 1; $i <= $jum_halaman; $i++) {
                  if ($i > $halaman - 5 && $i < $halaman + 5) {
                    if ($i != $halaman) {
                      echo "<li class='page-item'><a class='page-link' href='categories.php?halaman=$i$url_katakunci'>$i</a></li>";
                    } else {
                      echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                    }
                  }
                }
                if ($halaman < $jum_halaman) {
                  echo "<li class='page-item'><a class='page-link' href='categories.php?halaman=$setelah$url_katakunci'>»</a></li>";
                  echo "<li class='page-item'><a class='page-link' href='categories.php?halaman=$jum_halaman$url_katakunci'>Last</a></li>";
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
