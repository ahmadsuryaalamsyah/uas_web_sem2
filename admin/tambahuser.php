<?php session_start(); ?>

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
                            <h3><i class="fas fa-plus"></i> Tambah User</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="user.php">Data User</a></li>
                                <li class="breadcrumb-item active">Tambah User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data User</h3>
                        <div class="card-tools">
                            <a href="user.php" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                    <br>
                    <?php if (!empty($_SESSION['error_message'])): ?>
                        <div class="col-sm-10">
                            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
                        </div>
                    <?php endif; ?>
                    <form class="form-horizontal" method="post" action="konfirmasitambahuser.php" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="foto" class="col-sm-12 col-form-label"><span class="text-info"><i class="fas fa-user-circle"></i> <u>Data User</u></span></label>
                            </div>          
                            <div class="form-group row">
                                <label for="foto" class="col-sm-3 col-form-label">Foto </label>
                                <div class="col-sm-7">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="foto" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>  
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nama" id="nama" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="email" id="email" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="username" id="username" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" id="password" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="role" id="role">
                                        <option value="admin">admin</option>
                                        <option value="user">user</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-info float-right"><i class="fas fa-plus"></i> Tambah</button>
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
