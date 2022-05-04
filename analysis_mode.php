<?php
 #include("config.inc.php"); 
?>

<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Waranusmove - Move analysis tools</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <style>
      /* Make the image fully responsive */
      .carousel-inner img {
      width: 100%;
      height: 100%;
  }
    </style>

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Waranus Move</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#mode">Analysis Mode</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">How to</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Home</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" src="img/w_logo.png" alt="">
        <h1 class="text-uppercase mb-0">Waranus move</h1>
        <!-- <hr class="star-light"> -->
        <hr class="shrink-to-fit">
        <h2 class="font-weight-light mb-0">Web Abstract Analysis - Powerfully and Simply </h2>
      </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="mode">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Analysis Mode</h2>
        <hr class="shrink-to-fit">
        <div class="row" align="Centre">
          <div class="col-lg"> 
            <img class="img-fluid" src="img/portfolio/analysismode.png" alt="">
          </div>
          <div class="col-lg" style="background-color: lavenderblush;">

            <div class="container mt3">
              <h3 align="Left"> Browse your abstarct file.</h3>
                <form action="analysis_mode_feature.php" METHOD="POST" ENCTYPE="multipart/form-data" id="formUpload">
                  <label>Select Branch of abstract:</label>
                  <select class="custom-select custom-select-mb mb-3" id="field" name="field">
                    <option selected>Select branch of abstract...</option>
                    <option value="1">Biomedical Engineering</option>
                  </select>

                  <label>Select analysis model :</label>
                  <select class="custom-select custom-select-mb mb-3" id="model" name="model">
                    <option selected>Select model...</option>
                    <option value="1">Dicision tree</option>
                  </select>

                  <label>Select abstract file (.PDF) :</label>
                  <input id="upFile" type="file" name="fileupload">
                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Upload file</button>
                  </div>
                </form>
           </div>


          
      </div>
    </section>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">How to use WaranusMove</h2>
        <hr class="shrink-to-fit">
        <div class="row">
          <div class="col-lg col-md">
            
            <div id="demo" class="carousel slide" data-ride="carousel">

              <!-- Indicators -->
              <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
                <li data-target="#demo" data-slide-to="3"></li>
                <li data-target="#demo" data-slide-to="4"></li>
                <li data-target="#demo" data-slide-to="5"></li>
              </ul>
              
              <!-- The slideshow -->
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="img/slide/stept_cover_png.png" width="800" height="364">
                </div>
                <div class="carousel-item">
                  <img src="img/slide/stept1_png.png" width="800" height="364">
                </div>
                <div class="carousel-item">
                  <img src="img/slide/stept2_png.png" width="800" height="364">
                </div>
                <div class="carousel-item">
                  <img src="img/slide/stept3_png.png" width="800" height="364">
                </div>
                <div class="carousel-item">
                  <img src="img/slide/stept4_png.png" width="800" height="364">
                </div>
                <div class="carousel-item">
                  <img src="img/slide/stept5_png.png" width="800" height="364">
                </div>
              </div>
              
              <!-- Left and right controls -->
              <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>
            </div>

          </div>
        </div>

      </div>
    </section>

    <!-- Contact Section 
    <section id="contact">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Contact Me</h2>
        <hr class="star-dark mb-5">
        <hr class="shrink-to-fit">
        <div class="row">
          <div class="col-lg mx-auto">
            

          </div>
        </div>
      </div>
    </section> -->

    <!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Location</h4>
            <p class="lead mb-0">Computer Centre
              <br>Silpakorn University</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Around the Web</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="htts://www.facebook.com/hosbike2">
                  <i class="fab fa-fw fa-facebook-f"></i>
                </a>
              </li>
              
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://twitter.com/hosbike2">
                  <i class="fab fa-fw fa-twitter"></i>
                </a>
              </li>
              
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.cc.su.ac.th">
                  <i class="fab fa-fw fa-dribbble"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">About WaranusMove</h4>
            <p class="lead mb-0">WaranusMove is a web abstract analysis tool, M.Sc.IS.</p>
          </div>
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; www.cc.su.ac.th 2019</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <!-- Portfolio Modals -->

   

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>

