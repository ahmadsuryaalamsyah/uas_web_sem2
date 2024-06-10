<?php
    include('../koneksi/koneksi.php');
    if (isset($_POST['login'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $username = mysqli_real_escape_string($koneksi, $user);
        $password = mysqli_real_escape_string($koneksi, $pass);
        echo "Username: $username<br>";
        echo "Password (hashed): $password<br>";

        $sql = "SELECT `user_id`, `role` FROM `users` WHERE `username`='$username' AND `password`='$password'";
        $query = mysqli_query($koneksi, $sql);

        if (!$query) {
            die("Query Error: " . mysqli_error($koneksi));
        }
        $jumlah = mysqli_num_rows($query);
        if (empty($user)) {
            header("Location:index.php?gagal=userKosong");
        } else if (empty($pass)) {
            header("Location:index.php?gagal=passKosong");
        } else if ($jumlah == 0) {
            echo "Username or password incorrect.<br>";
            header("Location:index.php?gagal=userpassSalah");
        } else {
            session_start();
            while ($data = mysqli_fetch_row($query)) {
                $user_id = $data[0];
                $role = $data[1]; //admin, user
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role'] = $role;
                header("Location:profil.php");
            }
        }
    }
?>
