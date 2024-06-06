<?php 
session_start();
include('../koneksi/koneksi.php');

if ((isset($_GET['aksi'])) && (isset($_GET['data']))) {
    if ($_GET['aksi'] == 'hapus') {
        $tag_id = $_GET['data'];
        $sql_dh = "DELETE FROM `tags` WHERE `tag_id` = ?";
        $stmt = $koneksi->prepare($sql_dh);
        $stmt->bind_param("i", $tag_id);
        $stmt->execute();
        $stmt->close();
        header("Location: tag.php?notif=hapusberhasil");
        exit();
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
                            <h3><i class="fas fa-tag"></i> Tag</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Tag</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Tag</h3>
                        <div class="card-tools">
                            <a href="tambahtag.php" class="btn btn-sm btn-info float-right">
                                <i class="fas fa-plus"></i> Tambah Tag
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form method="get" action="tag.php">
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
                            <?php if (!empty($_GET['notif'])) { ?>
                                <?php if ($_GET['notif'] == "tambahberhasil") { ?>
                                    <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                                <?php } elseif ($_GET['notif'] == "editberhasil") { ?>
                                    <div class="alert alert-success" role="alert"> Data Berhasil Diubah</div>
                                <?php } elseif ($_GET['notif'] == "hapusberhasil") { ?>
                                    <div class="alert alert-success" role="alert"> Data Berhasil Dihapus</div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <table class="table table-bordered">
                            <thead>                  
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="80%">Tag</th>
                                    <th width="15%"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $batas = 3;
                                if (!isset($_GET['halaman'])) {
                                    $posisi = 0;
                                    $halaman = 1;
                                } else {
                                    $halaman = $_GET['halaman'];
                                    $posisi = ($halaman - 1) * $batas;
                                }

                                $sql_k = "SELECT `tag_id`, `name` FROM `tags`";
                                if (isset($_GET["katakunci"])) {
                                    $katakunci = mysqli_real_escape_string($koneksi, $_GET["katakunci"]);
                                    $sql_k .= " WHERE `name` LIKE '%$katakunci%'";
                                }
                                $sql_k .= " ORDER BY `name` LIMIT ?, ?";
                                $stmt_k = $koneksi->prepare($sql_k);
                                $stmt_k->bind_param("ii", $posisi, $batas);
                                $stmt_k->execute();
                                $result_k = $stmt_k->get_result();
                                $no = $posisi + 1;

                                while ($data_k = $result_k->fetch_assoc()) {
                                    $tag_id = $data_k['tag_id'];
                                    $name = $data_k['name'];
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td align="center">
                                        <a href="edittag.php?data=<?php echo $tag_id; ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $name; ?>?'))window.location.href = 'tag.php?aksi=hapus&data=<?php echo $tag_id; ?>&notif=hapusberhasil'" class="btn btn-xs btn-warning"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $sql_jum = "SELECT `tag_id`, `name` FROM `tags`"; 
                    if (isset($_GET["katakunci"])) {
                        $katakunci = mysqli_real_escape_string($koneksi, $_GET["katakunci"]);
                        $sql_jum .= " WHERE `name` LIKE '%$katakunci%'";
                    }
                    $sql_jum .= " ORDER BY `name`";
                    $query_jum = mysqli_query($koneksi, $sql_jum);
                    $jum_data = mysqli_num_rows($query_jum);
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
                               echo "<li class='page-item'><a class='page-link' href='tag.php?halaman=1$url_katakunci'>First</a></li>";
                               echo "<li class='page-item'><a class='page-link' href='tag.php?halaman=$sebelum$url_katakunci'>«</a></li>";
                             }
                             for ($i = 1; $i <= $jum_halaman; $i++) {
                               if ($i > $halaman - 5 && $i < $halaman + 5) {
                                 if ($i != $halaman) {
                                   echo "<li class='page-item'><a class='page-link' href='tag.php?halaman=$i$url_katakunci'>$i</a></li>";
                                 } else {
                                   echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                                 }
                               }
                             }
                             if ($halaman < $jum_halaman) {
                               echo "<li class='page-item'><a class='page-link' href='tag.php?halaman=$setelah$url_katakunci'>»</a></li>";
                               echo "<li class='page-item'><a class='page-link' href='tag.php?halaman=$jum_halaman$url_katakunci'>Last</a></li>";
                             }
                           }
                           ?>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
    </div>
    <?php include("includes/footer.php") ?>
  </div>
  <?php include("includes/script.php") ?>
</body>
</html>
