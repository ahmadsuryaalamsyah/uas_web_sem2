<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>News HTML-5 Template</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="manifest" href="site.webmanifest" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico" />

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/css/slicknav.css" />
    <link rel="stylesheet" href="assets/css/animate.min.css" />
    <link rel="stylesheet" href="assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="assets/css/themify-icons.css" />
    <link rel="stylesheet" href="assets/css/flaticon.css" />
    <link rel="stylesheet" href="assets/css/slick.css" />
    <link rel="stylesheet" href="assets/css/nice-select.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
  </head>

  <body>
    <!-- Preloader Start -->
    <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
          <div class="preloader-circle"></div>
          <div class="preloader-img pere-text">
            <img src="assets/img/logo/loder.png" alt="" />
          </div>
        </div>
      </div>
    </div>
    <!-- Preloader Start -->

    <header>
       <?php include('include/header.php'); ?>
    </header>

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
      <div class="container">
        <form class="form-horizontal" role="form" id="contactForm" method="post">
      	      <div class="form-group">
      		      <label for="name" class="col-sm-2 control-label">Name</label>
      		       <div class="col-sm-10">
                 <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="">
      		      </div>
      	    </div>
          	<div class="form-group">
      	    	<label for="email" class="col-sm-2 control-label">Email</label>
      		     <div class="col-sm-10">
               <input type="email" class="form-control" id="email" name="email" placeholder="contoh@gamil.com" value="">
      		    </div>
        	</div>
      	<div class="form-group">
      		<label for="message" class="col-sm-2 control-label">Message</label>
      		<div class="col-sm-10">
          <textarea class="form-control" rows="4" name="message" placeholder="Your Message"></textarea>
      		</div>
      	</div>
      	<div class="form-group">
      		<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
      		<div class="col-sm-10">
      			<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-sm-10 col-sm-offset-2">
      			<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
      		</div>
      	</div>
      </form> 
      </div>
        <div class="row col-lg-10 mx-auto">
          <div class="col-lg-12">
            <h2 class="contact-title">Get in Touch</h2>
          </div>
          <div class="col-lg-8">
            <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message"></textarea>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject" />
                  </div>
                </div>
              </div>
              <div class="form-group mt-3">
                <button type="submit" class="button button-contactForm boxed-btn">Send</button>
              </div>
            </form>
          </div>
          <div class="col-lg-3 offset-lg-1">
            <div class="media contact-info">
              <span class="contact-info__icon"><i class="ti-home"></i></span>
              <div class="media-body">
                <h3>Buttonwood, California.</h3>
                <p>Rosemead, CA 91770</p>
              </div>
            </div>
            <div class="media contact-info">
              <span class="contact-info__icon"><i class="ti-tablet"></i></span>
              <div class="media-body">
                <h3>+1 253 565 2365</h3>
                <p>Mon to Fri 9am to 6pm</p>
              </div>
            </div>
            <div class="media contact-info">
              <span class="contact-info__icon"><i class="ti-email"></i></span>
              <div class="media-body">
                <h3>support@colorlib.com</h3>
                <p>Send us your query anytime!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ contact section end ================= -->

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

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        $("#contactForm").submit(function (event) {
            event.preventDefault();
            var name = $("#name").val();
            var email = $("#email").val();
            var message = $("#message").val();
            var human = $("#human").val();
            alert("pesan terkirim");
            $("#contactForm").trigger("reset");
        });
    });
</script>

  </body>
</html>
