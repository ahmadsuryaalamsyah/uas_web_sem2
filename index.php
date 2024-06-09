<?php include_once("koneksi/koneksi.php");?>
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
    </head>
            
    <body>
        <header>
            <?php include('include/header.php')?>
        </header>

        <main>
            <div class="trending-area fix">
                <div class="container">
                    <div class="trending-main">
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
                        <div class="row">
                            <?php 
                                $sql_k = "SELECT `name`,`title`,`cover`, DATE_FORMAT(`created_at`, '%d-%m-%Y'),`article_id` FROM `articles`
                                INNER JOIN `categories` ON `articles`.`category_id` = `categories`.`category_id` 
                                WHERE `article_id`='1'";
                                $query_k = mysqli_query($koneksi,$sql_k);
                                while($data_k = mysqli_fetch_row($query_k)){
                                    $name= $data_k[0];
                                    $title= $data_k[1];
                                    $cover= $data_k[2];
                                    $date= $data_k[3];
                                    $article_id= $data_k[4];
                            ?>
                            <div class="col-lg-12">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img src="admin/cover/<?php echo htmlspecialchars($cover); ?>" alt="" width="700px">
                                        <div class="trend-top-cap">
                                            <span><?php echo htmlspecialchars($name); ?>, <?php echo htmlspecialchars($date); ?></span>
                                            <h2><a href="details.php?data=<?php echo htmlspecialchars($article_id); ?>"><?php echo htmlspecialchars($title); ?></a></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                            ?>

                            <div class="trending-bottom">
                                <div class="row">
                                    <?php 
                                        $sql_k = "SELECT `name`, `title`, `cover`, DATE_FORMAT(`created_at`, '%d-%m-%Y'), `article_id` FROM `articles` 
                                                  INNER JOIN `categories` ON `articles`.`category_id` = `categories`.`category_id` 
                                                  WHERE `article_id` BETWEEN 2 AND 4";
                                        $query_k = mysqli_query($koneksi, $sql_k);
                                        while ($data_k = mysqli_fetch_row($query_k)) {
                                            $name = $data_k[0];
                                            $title = $data_k[1];
                                            $cover = $data_k[2];
                                            $date = $data_k[3];
                                            $article_id = $data_k[4];
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="single-bottom mb-35">
                                            <div class="trend-bottom-img mb-30">
                                                <img style="max-height: 250px" src="admin/cover/<?php echo htmlspecialchars($cover); ?>" alt="">
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color1"><?php echo htmlspecialchars($name); ?>, <?php echo htmlspecialchars($date); ?></span>
                                                <h4><a href="details.php?data=<?php echo htmlspecialchars($article_id); ?>"><?php echo htmlspecialchars($title); ?></a></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Trending Area End -->
            <!-- Weekly-News start -->
           <div class="weekly-news-area pt-50">
               <div class="container">
                   <div class="weekly-wrapper">
                       <!-- section Tittle -->
                       <div class="row">
                           <div class="col-lg-12">
                               <div class="section-tittle mb-30">
                                   <h3>Weekly Top News</h3>
                               </div>
                           </div>
                       </div>
                       <div class="weekly-top-news">
                           <div class="row">
                               <?php 
                                   $sql_k = "SELECT `a`.`title`, `a`.`cover`, DATE_FORMAT(`a`.`created_at`, '%d-%m-%Y') AS `formatted_date`, `a`.`article_id`, COUNT(`c`.`comment_id`) AS `comment` 
                                             FROM `articles` `a` 
                                             INNER JOIN `comments` `c` ON `a`.`article_id` = `c`.`article_id` 
                                             GROUP BY `a`.`article_id`
                                             ORDER BY `comment` DESC 
                                             LIMIT 3";
                                   $query_k = mysqli_query($koneksi, $sql_k);
                                   while ($data_k = mysqli_fetch_row($query_k)) {
                                       $title = $data_k[0];
                                       $cover = $data_k[1];
                                       $date = $data_k[2];
                                       $article_id = $data_k[3];
                                       $comment = $data_k[4];
                               ?>
                               <div class="col-lg-4">
                                   <div class="single-bottom mb-35">
                                       <div class="trend-bottom-img mb-30">
                                           <img style="width: 350px; height: 250px;" src="admin/cover/<?php echo htmlspecialchars($cover); ?>" alt="">
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
                   </div>
               </div>
           </div>

            <!-- End Weekly-News -->
            <!-- Whats New Start -->
            <section class="whats-news-area pt-50 pb-20">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row d-flex justify-content-between">
                                <div class="col-lg-3 col-md-3">
                                    <div class="section-tittle mb-30">
                                        <h3>Latest news</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php 
                                    $sql_k = "SELECT `name`, `title`, `cover`, DATE_FORMAT(`created_at`, '%d-%m-%Y'), `article_id` FROM `articles` 
                                              INNER JOIN `categories` ON `articles`.`category_id` = `categories`.`category_id` 
                                              ORDER BY `articles`.`created_at` DESC limit 6";
                                    $query_k = mysqli_query($koneksi, $sql_k);
                                    while ($data_k = mysqli_fetch_row($query_k)) {
                                        $name = $data_k[0];
                                        $title = $data_k[1];
                                        $cover = $data_k[2];
                                        $date = $data_k[3];
                                        $article_id = $data_k[4];
                                ?>
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img style="width: 350px" height="250px" src="admin/cover/<?php echo htmlspecialchars($cover); ?>" alt="">
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
                    </div>
                </div>
            </section>
            <!-- Whats New End -->
            <!-- End pagination  -->
        </main>
        
        <footer>
            <!-- Footer Start-->
            <?php include('include/footer.php') ?>
            <!-- Footer End-->
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
