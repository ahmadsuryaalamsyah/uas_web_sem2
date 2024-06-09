<?php include_once("koneksi/koneksi.php"); ?>
<?php 
$category_id = null;
if (isset($_GET['data'])) {
    $category_id = $_GET['data'];
    $sql = "SELECT `articles`.`title`, `articles`.`cover`, DATE_FORMAT(`articles`.`created_at`, '%d-%m-%Y') as `formatted_date`,`categories`.`name` ,`articles`.`article_id`, `articles`.`category_id` 
            FROM `articles`
            INNER JOIN `categories` ON `articles`.`category_id` = `categories`.`category_id`
            WHERE `articles`.`category_id` = $category_id 
            ORDER BY `articles`.`created_at` DESC";
    $query = mysqli_query($koneksi, $sql);
    $posts = [];
    while ($data = mysqli_fetch_assoc($query)) {
        $posts[] = $data;
    }
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>News HTML-5 Template</title>
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
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader Start -->

    <header>
       <?php include('include/header.php'); ?>
    </header>

    <main>
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-3">
                            <div class="section-tittle mb-30">
                                <h3>Whats New</h3>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->                                            
                                <nav>                                                                     
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <?php 
                                        $sql_k = "SELECT `category_id`, `name` FROM `categories` ORDER BY `name`";
                                        $query_k = mysqli_query($koneksi, $sql_k);
                                        while ($data_k = mysqli_fetch_row($query_k)) {
                                            $cat_id = $data_k[0];
                                            $name = $data_k[1];
                                            $active_class = ($cat_id == $category_id) ? 'active' : '';
                                        ?>
                                            <li><a class="nav-item nav-link <?php echo $active_class; ?>" id="nav-home-tab" href="categori.php?data=<?php echo $cat_id; ?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo $name; ?></a></li>
                                        <?php } ?>
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- card one -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">           
                                    <div class="whats-news-caption">
                                        <div class="weekly-top-news">
                                        <div class="row">
                                            <?php if (!empty($posts)): ?>
                                                <?php foreach ($posts as $post): ?>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="single-bottom mb-35">
                                                        <div class="trend-bottom-img mb-30">
                                                            <img style="width: 100%; height: 250px;" src="admin/cover/<?php echo htmlspecialchars($post['cover']); ?>" alt="">
                                                        </div>
                                                        <div class="trend-bottom-cap">
                                                            <span class="color1"><?php echo htmlspecialchars($post['name']); ?>, <?php echo htmlspecialchars($post['formatted_date']); ?></span>
                                                            <h5><a href="details.php?data=<?php echo htmlspecialchars($post['article_id']); ?>"><?php echo htmlspecialchars($post['title']); ?></a></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                            <div class="weekly-top-news">
                                                <div class="row">
                                                    <?php 
                                                    $sql_k = "SELECT `a`.`title`, `a`.`cover`, DATE_FORMAT(`a`.`created_at`, '%d-%m-%Y') AS `formatted_date`, `a`.`article_id`, COUNT(`c`.`comment_id`) AS `comment` 
                                                            FROM `articles` `a` 
                                                            INNER JOIN `comments` `c` ON `a`.`article_id` = `c`.`article_id` 
                                                            GROUP BY `a`.`article_id`
                                                            ORDER BY `comment` DESC 
                                                            LIMIT 9";
                                                    $query_k = mysqli_query($koneksi, $sql_k);
                                                    while ($data_k = mysqli_fetch_row($query_k)) {
                                                        $title = $data_k[0];
                                                        $cover = $data_k[1];
                                                        $date = $data_k[2];
                                                        $article_id = $data_k[3];
                                                        $comment = $data_k[4];
                                                    ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="single-bottom mb-35">
                                                            <div class="trend-bottom-img mb-30">
                                                                <img style="width: 100%; height: 250px;" src="admin/cover/<?php echo htmlspecialchars($cover); ?>" alt="">
                                                            </div>
                                                            <div class="trend-bottom-cap">
                                                                <span class="color1"><?php echo htmlspecialchars($name); ?>, <?php echo htmlspecialchars($date); ?></span>
                                                                <h5><a href="details.php?data=<?php echo htmlspecialchars($article_id); ?>"><?php echo htmlspecialchars($title); ?></a></h5>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <?php 
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->

    <!-- Start pagination -->
    <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End pagination -->
    </main>
   
   <footer>
      <?php include('include/footer.php'); ?>
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

    <!-- Breaking New Pluging -->
    <script src="./assets/js/jquery.ticker.js"></script>
    <script src="./assets/js/site.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    
    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>
