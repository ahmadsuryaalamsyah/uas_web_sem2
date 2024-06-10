<?php 
session_start();
include('koneksi/koneksi.php');

if(isset($_GET['data'])){
  $article_id = $_GET['data'];

  $sql = "SELECT `b`.`cover`, `b`.`title`, `b`.`content`, DATE_FORMAT(`b`.`created_at`, '%d-%m-%Y') AS `create_at`, `u`.`nama`,`t`.`name` AS `tag`
          FROM `articles` `b`
          INNER JOIN `users` `u` ON `b`.`author_id` = `u`.`user_id`
          INNER JOIN `article_tags` `at` ON `b`.`article_id` = `at`.`article_id`
          INNER JOIN `tags` `t` ON `at`.`tag_id` = `t`.`tag_id`
          WHERE `b`.`article_id`='$article_id'"; 

  $query = mysqli_query($koneksi, $sql);
  if ($query) {
    if ($data = mysqli_fetch_assoc($query)) {
      $cover = htmlspecialchars($data['cover']);
      $judul = htmlspecialchars($data['title']);
      $isi = htmlspecialchars($data['content']); 
      $create_at = htmlspecialchars($data['create_at']); 
      $nama_penulis = htmlspecialchars($data['nama']);
      $tag = htmlspecialchars($data['tag']);
    } else {
      echo "Data tidak ditemukan.";
      exit();
    }
  } else {
    echo "Error dalam query: " . mysqli_error($koneksi);
    exit();
  }
} else {
  echo "Data tidak ditemukan.";
  exit();
}
?>
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>News HTML-5 Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/ticker-style.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <?php include('include/header.php')?>
    </header>

    <main>
        <!-- About US Start -->
        <div class="about-area">
            <div class="container">
                <!-- Hot Animated News Title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">Bangladesh dolor sit amet, consectetur adipisicing elit.</li>
                                    <li class="news-item">Spondon IT sit amet, consectetur.......</li>
                                    <li class="news-item">Rem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article and Comments Section -->
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Article Content -->
                        <div class="about-right mb-90">
                            <div class="about-img">
                                <img src="admin/cover/<?php echo $cover;?>" alt="">
                            </div>
                            <div class="section-tittle mb-30 pt-30">
                                <h3><?php echo $judul; ?></h3>
                                <p><?php echo $create_at; ?>, by <?php echo $nama_penulis; ?></p>
                            </div>
                            <div class="about-prea">
                                <p class="about-pera1 mb-25"><?php echo $isi; ?></p>
                                <p class="about-pera2 mb-25">Tags: <?php echo $tag; ?></p>
                            </div>
                            <div class="mt-3">
                             <div class="border border-top"></div>
                              <div class="section-comment mb-30 pt-30">
                                 <h3>Comments</h3>
                                 <?php 
                                 $sql_b = "SELECT `c`.`comment_id`, `c`.`content`, `u`.`username`, `u`.`foto`, DATE_FORMAT(`c`.`created_at`, '%d-%m-%Y') AS `create_at`
                                           FROM `comments` `c`
                                           INNER JOIN `users` `u` ON `c`.`user_id` = `u`.`user_id`
                                           WHERE `c`.`article_id`='$article_id'";
                                 $query_b = mysqli_query($koneksi, $sql_b);
                                 $comment_count = mysqli_num_rows($query_b);
                                 if($comment_count > 0) {
                                     while($data_b = mysqli_fetch_assoc($query_b)){
                                         $comment_id = $data_b['comment_id'];
                                         $content = $data_b['content'];
                                         $username = $data_b['username'];
                                         $foto = $data_b['foto'];
                                         $created_at = $data_b['create_at'];

                                 ?>
                                 <div class="d-flex flex-start mt-3">
                                     <img class="rounded-circle shadow-1-strong me-3" src="admin/foto/<?php echo htmlspecialchars($foto); ?>" alt="avatar" width="60" height="60" />
                                     <div class="px-3">
                                         <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($username); ?></h6>
                                         <div class="d-flex align-items-center mb-2">
                                             <p class="mb-0"><?php echo htmlspecialchars($created_at); ?></p>
                                             <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                                             <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                                             <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>
                                         </div>
                                         <p class="mb-0"><?php echo htmlspecialchars($content); ?></p>
                                         
                                     </div>
                                 </div>
                                 <?php 
                                     }
                                 } else {
                                 ?>
                                 <div class="d-flex flex-start mt-3">
                                     <p>Belum ada komentar</p>
                                 </div>
                                 <?php 
                                 }
                                 ?>
                             </div>
                         </div>

                            <div class="social-share pt-30">
                                <div class="section-tittle">
                                    <h3 class="mr-20">Share:</h3>
                                    <ul>
                                        <li><a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a></li>
                                        <li><a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a></li>
                                        <li><a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a></li>
                                        <li><a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Comment Form -->
                        <div class="row">
                            <div class="col-lg-8">
                                <form class="form-contact contact_form mb-80"  role="form" id="contactForm" method="post">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea class="form-control w-100 error" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control error" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control error" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input class="form-control error" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Content -->
                    <div class="col-lg-4">
                        <!-- Section Title -->
                        <div class="section-tittle mb-40">
                            <h3>Follow Us</h3>
                        </div>
                        <!-- Follow Social -->
                        <div class="single-follow mb-45">
                            <div class="single-box">
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New Poster -->
                        <div class="news-poster d-none d-lg-block">
                            <img src="assets/img/news/news_card.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About US End -->
    </main>

    <footer>
        <?php include('include/footer.php') ?>
    </footer>

    <!-- JS here -->
    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <!-- Breaking News Plugin -->
    <script src="./assets/js/jquery.ticker.js"></script>
    <script src="./assets/js/site.js"></script>
    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <!-- Contact JS -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script>
    $(document).ready(function () {
        $("#contactForm").submit(function (event) {
            event.preventDefault();
            var name = $("#name").val();
            var email = $("#email").val();
            var message = $("#message").val();
            var subject = $("#subject").val();
            alert("pesan terkirim");
            $("#contactForm").trigger("reset");
        });
    });
</script>
</body>
</html>
