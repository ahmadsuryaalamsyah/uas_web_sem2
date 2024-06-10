<?php
session_start();
include('../koneksi/koneksi.php');
 $katakunci = isset($_POST['katakunci']) ? $_POST['katakunci'] : "";
 $sql = "SELECT `user_id`, `nama`, `email`, `role` FROM `users`";
 if (!empty($katakunci)) {
     $sql .= " WHERE `nama` LIKE '%$katakunci%' OR `email` LIKE '%$katakunci%'";
 }
 $sql .= " ORDER BY `nama`";
 $query = mysqli_query($koneksi, $sql);
 if (!$query) {
     die("Query Error: " . mysqli_error($koneksi));
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
                        <h3><i class="fas fa-user-tie"></i> Data User</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar User</h3>
                    <div class="card-tools">
                        <a href="tambahuser.php" class="btn btn-sm btn-info float-right">
                        <i class="fas fa-plus"></i> Tambah User</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form method="post" action="user.php">
                            <div class="row">
                                <div class="col-md-4 bottom-10">
                                    <input type="text" class="form-control" id="kata_kunci" name="katakunci" value="<?php echo $katakunci; ?>">
                                </div>
                                <div class="col-md-5 bottom-10">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                                </div>
                            </div>
                        </form>
                    </div><br>
                    <?php if(!empty($_GET['notif'])): ?>
                        <?php if($_GET['notif'] == "tambahberhasil"): ?>
                            <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                        <?php elseif($_GET['notif'] == "editberhasil"): ?>
                            <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                        <?php elseif($_GET['notif'] == "hapusberhasil"): ?>
                            <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <table class="table table-bordered">
                        <thead>                  
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Nama</th>
                                <th width="30%">Email</th>
                                <th width="20%">Role</th>
                                <th width="15%"><center>Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = mysqli_fetch_row($query)) {
                                $user_id = $data[0];
                                $nama = $data[1];
                                $email = $data[2];
                                $role = $data[3];
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $nama; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $role; ?></td>
                                <td align="center">
                                    <a href="edituser.php?user_id=<?php echo $user_id; ?>" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="detailuser.php?id=<?php echo $user_id; ?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="hapususer.php?id=<?php echo $user_id; ?>" class="btn btn-xs btn-warning" onclick="return confirm('Anda yakin ingin menghapus data ini?')" title="Hapus"><i class="fas fa-trash"></i></a>                         
                                </td>
                            </tr>
                            <?php
                            $no++;
                            }
                            ?>
                        </tbody>
                    </table>  
                </div>
                <div class="card-footer clearfix"></div>
            </div>
        </section>
    </div>
    <?php include("includes/footer.php"); ?>
</div>
<?php include("includes/script.php"); ?>
</body>
</html>
