<?php
	include ("config.inc.php");
?>

<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Waranusmove - Move analysis tools</title>

    <!-- Drag and drop file -->
    <link href="http://demo.expertphp.in/css/dropzone.css" rel="stylesheet">
    <script src="http://demo.expertphp.in/js/dropzone.js"></script>
    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    

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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#mode">Training mode</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#characteristic">Characteristic of the abstract</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#howto">How to</a>
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
        <h2 class="text-center text-uppercase text-secondary mb-0">Training Mode</h2>
        <hr class="shrink-to-fit">

        <div class="row" align="Centre">
          <div class="col-lg"> 
            <img class="img-fluid" src="img/portfolio/trainingmode.png" alt="">
          </div>

          <div class="col-lg" style="background-color: lavender;">
            <div class="container mt3">
              <h3 align="Left"> Fill detail of new model.</h3>
                <form action="training_mode_trainingmodel.php" METHOD="POST" ENCTYPE="multipart/form-data" id="myform">

                  <div class="form-group">
                    <label>Field of abstract:</label>
                    <input type="field" class="form-control" id="field" placeholder="Enter field..." name="field">
                  </div>

                  <div class="form-group">
                    <label>Abbreviation name of field:</label>
                    <input type="field" class="form-control" id="field" placeholder="Enter abbreviation name..." name="shortfield">
                  </div>

                  <div class="form-group">
                  <label>Select analysis model :</label>
                  <select class="custom-select custom-select-mb mb-3" id="model" name="model">
                    <option selected>Select model...</option>
                    <option value="Support vector machine">Support vector machine</option>
                    <option value="Dicision tree">Dicision tree</option>
                    <option value="Naive bayes">Naive bayes</option>
                    <option value="Ramdom forest">Ramdom forest</option>
                  </select>
                  </div>

                    <div class="mt-3">
                      <button type="submit" name="submit" class="btn btn-success">Start training</button>
                    </div>
                </form>

            </div>
        </div>   

        <div class="container" align="Centre">
          <label>Drop training abstract file (.txt) :</label>
          <form method="POST" action="upload.php" accept-charset="UTF-8" class="dropzone" id="file-upload" enctype="multipart/form-data">
          <input name="_token" type="hidden" value="HqKhUzxAQ6d47iAsby4UojdZz3FGaXa2fh2RTwX9">
          </form>
        </div>

      </div>
    </section>

    <!-- Characteristic of abstract -->
    <section class="bg-primary text-white mb-0" id="characteristic">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">Characteristic of abstract</h2>
        <hr class="shrink-to-fit">

        <div class="row">
          <div class="col-lg col-md">
          	<h3 class="text-center text-uppercase">Characteristic of abstract</h3>
          		<ul style="list-style-type:disc;" class="">
  					   <li><h4>Summary of the research</h4> </li>
  					   <li><h4>Acceptance / rejection </h4></li>
  					   <li><h4>A snapshot of the research</h4></li>
  					   <li><h4>A fast means to acquire and dissmanate knowlwdge</h4></li>
				      </ul>  
          </div>
          <div class="col-lg col-md"> <img class="img-fluid" src="img/portfolio/research.png" alt=""> </div>
        </div>

      </div>
    </section>

    <!-- Move Section -->
    <section id="#">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Abstract component</h2>
        <h3 class="text-center text-uppercase text-secondary mb-0">Each component calls "Move"</h3>
        <hr class="shrink-to-fit">
        <div class="row">
          <div class="col-md-6 lg-4">
            <img class="img-fluid" src="img/portfolio/icon_background.png" alt="">
          </div>
          <div class="col-md-6 lg-4">
          	<div class="card">

            <a href="#b" class="btn btn-primary" data-toggle="collapse" > <h3 class="text-center text-uppercase">Background move</h3></a>
            	<div id="b" class="collapse">
            		<ul style="list-style-type:disc;" class="">
  					<li><h4>Background information about the topic</h4> </li>
					</ul>  
            	</div>

            <ul style="list-style-type:disc;" class="">
  				<li> <a href="#popup" title="Most vocabulary use in Background move." data-toggle="popover" data-trigger="focus" data-content="It is known that... / It is accpted... / It is recognized..."> It is known that </a> / <a href="#popup" title="Most subject use in Background move." data-toggle="popover" data-trigger="focus" data-content="It or We">we known </a> that...... </li>
  				<li> Data mining is <a href="#popup" title="Most keyword use in Background move." data-toggle="popover" data-trigger="focus" data-content="vital / crucial / neccessary / essential / indispensable">important.</a></li>
			</ul> 

			<h4 class="text-center text-uppercase">Eaxmple</h4>
            	<ul style="list-style-type:disc;" class="">
  					<li> <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="This is a keyword. It tells about general topic of research.">There is a growing interest </a> in the development of would dressings that possess functionality beyond providing physical protection and an optimal moisture environment for the wound.</li>
				</ul> 
				<ul style="list-style-type:disc;" class="">
  					<li> <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="This is a keyword. It tells about the importain of computer.">It is known that computer are indispensable </a> in all aspects of life, including education, bussiness and communication.</li>
				</ul> 
            
            </div>
          </div>
          <div class="col-md-6 lg-4">
          	<div class="card">

            <a href="#p" class="btn btn-primary" data-toggle="collapse" > <h3 class="text-center text-uppercase">Purpose move</h3></a>
            	<div id="p" class="collapse">
            		<ul style="list-style-type:disc;" class="">
            		<li><h4>Purpose / Objective / Goal / Aim</h4> </li>
  					<li><h4>Objective of the study.</h4> </li>
  					<li><h4>Purpose is the goal of the study.</h4> </li>
					</ul>  
            	</div>
            
            	<ul style="list-style-type:disc;" class="">
  					<li><p>The<a href="#popup" title="keyword of Purpose move." data-toggle="popover" data-trigger="focus" data-content="Purpose / Object / Goal / Aim"> objcetive </a> of this study <a href="#popup" title="Tense of Purpose Move." data-toggle="popover" data-trigger="focus" data-content="Present or Past tense"> is/was..... </a> </p> </li>
  				</ul>

  				<div class="container">
  					<div class="alert alert-danger alert-dismissible fade show">
    					<button type="button" class="close" data-dismiss="alert">&times;</button>
    					<strong>Note that : </strong> Purpose move must appear in every abstract of research.
  					</div>
  				</div>

			<h4 class="text-center text-uppercase">Eaxmple</h4>
			<ul style="list-style-type:disc;" class="">
  					<li> <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="This is a keyword.">The objective of this paper </a> is to present the image formation theory for multifrequency vibro-acoustography.</li>
				</ul> 
				<ul style="list-style-type:disc;" class="">
  					<li> <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="This is a keyword. This study / focuses on are keyword that telling about purpose of research.">This study focuses on </a> the application of computer in business communicaion.</li>
				</ul> 
            </div>
          </div>
          <div class="col-md-6 lg-4">
            <img class="img-fluid" src="img/portfolio/icon_purpose.png" alt="">
          </div>
          <div class="col-md-6 lg-4">
            <img class="img-fluid" src="img/portfolio/icon_methods.png" alt="">
          </div>
          <div class="col-md-6 lg-4">

          	<div class="card">
          		<a href="#m" class="btn btn-primary" data-toggle="collapse" > <h3 class="text-center text-uppercase">Method move</h3></a>
            	<div id="m" class="collapse">
            		<ul style="list-style-type:disc;" class="">
            			<li><h4>Methods / Methodology / Experimental procedures / Procedures</h4> </li>
  						<li><h4>This move telling about the process of search study.</h4> </li>
					</ul>  
            	</div>

            	<ul style="list-style-type:disc;" class="">
            		<li><p>The researcher <a href="#popup" title="English grammar." data-toggle="popover" data-trigger="focus" data-content="This is ACTIVE VOICE sentecne."> investigated </a> the use if computers. / The use of computers <a href="#popup" title="English grammar." data-toggle="popover" data-trigger="focus" data-content="This is PASSIVE VOICE sentence."> was investigated. </a></p> </li>
				</ul>

				<h4 class="text-center text-uppercase">Eaxmple</h4>
				<ul style="list-style-type:disc;" class="">
  					<li>  Cells <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="PASSIVE VOICE sentence."> were cultured </a> in osteogenic medium snd mineral was added to culture at different stages in cell maturation.</li>
				</ul> 
				<ul style="list-style-type:disc;" class="">
  					<li> <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="PASSIVE VOICE sentence."> A number of 100 company employees were interviewed </a> with regard to 1) the number of hours spent on using computer, 2) the purposes of the computer use, and 3) the advantages and disadvantages of useing computer for business communication.</li>
				</ul>
				<ul style="list-style-type:disc;" class="">
  					<li>  Cells <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="The interviewees spent the times."> The interviewees generally spent 4-6 hours </a> in front of the monitor to record information.</li>
				</ul> 


          	</div>

          </div>
          <div class="col-md-6 lg-4">
            
            <div class="card">
            	<a href="#r" class="btn btn-primary" data-toggle="collapse" > <h3 class="text-center text-uppercase">Result move</h3></a>
            	<div id="r" class="collapse">
            		<ul style="list-style-type:disc;" class="">
            			<li><h4>Results / Findings </h4> </li>
  						<li><h4>This move telling about the process of search study.</h4> </li>
					</ul>  
            	</div>

            	<ul style="list-style-type:disc;" class="">
            		<li><p> <a href="#popup" title="Keyword!." data-toggle="popover" data-trigger="focus" data-content="Keyword is result and suggest."> The results seem to suggest </a>  that... /  <a href="#popup" title="Keyword!." data-toggle="popover" data-trigger="focus" data-content="Keyword is result and suggest."> The results suggest that... </a></p> </li>
				</ul>

				<div class="container">
  					<div class="alert alert-warning alert-dismissible fade show">
    					<button type="button" class="close" data-dismiss="alert">&times;</button>
    					<strong>Note that! : </strong> Result move is very important.
  					</div>
  				</div>

				<h4 class="text-center text-uppercase">Eaxmple</h4>

				<ul style="list-style-type:disc;" class="">
  					<li> <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="PASSIVE VOICE sentence."> A number of 100 company employees were interviewed </a> with regard to 1) the number of hours spent on using computer, 2) the purposes of the computer use, and 3) the advantages and disadvantages of useing computer for business communication.</li>
				</ul>
				<ul style="list-style-type:disc;" class="">
  					<li> <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="The interviewees spent the times."> The interviewees generally spent 4-6 hours </a> in front of the monitor to record information.</li>
				</ul> 

            </div>

          </div>
          <div class="col-md-6 lg-4">
            <img class="img-fluid" src="img/portfolio/icon_result.png" alt="">
          </div>
          <div class="col-md-6 lg-4">
            <img class="img-fluid" src="img/portfolio/icon_discussion.png" alt="">
          </div>
          <div class="col-md-6 lg-4">
            <div>

            	<div class="card">

            	<a href="#r" class="btn btn-primary" data-toggle="collapse" > <h3 class="text-center text-uppercase">Discussion move</h3></a>
            	<div id="r" class="collapse">
            		<ul style="list-style-type:disc;" class="">
            			<li><h4>Discussion / Conclusion / Implications / Interpretation / Explanation </h4> </li>
  						<li><h4>This move explain about overall of result in research.</h4> </li>
					</ul>  
            	</div>

            	<h4 class="text-center text-uppercase">Eaxmple</h4>

            	<ul style="list-style-type:disc;" class="">
  					<li> <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="Keyword."> In conclusion </a> we believe that the correction method shows promise for aiding human and computerized tissue classfication from MR signal intensities.</li>
				</ul>
				<ul style="list-style-type:disc;" class="">
  					<li> Even though computer aer help full in business communication, the decrease in personal interraction <a href="#tooltips" data-toggle="tooltip" data-placement="top" title="Keyword."> can be </a> considered a disadvantage.</li>
				</ul>
				<ul style="list-style-type:disc;" class="">
  					<li> This study suggests that, despite the crucial role of computer, human interaction is still missing from thistype of technology.</li>
				</ul>

            	</div>

            </div>

        </div>
      </div>
    </section>

    <!-- How to -->
    <section class="bg-primary text-white mb-0" id="howto">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">How to training new model</h2>
        <hr class="shrink-to-fit">
        <div class="row">
          <div class="col-lg col-md">
          	สวัสดี
          </div>
        </div>

      </div>
    </section>

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

    <!-- Popover function -->
    <script>
		$(document).ready(function(){
  		$('[data-toggle="popover"]').popover();   
		});
	</script>
	<!-- Tooltips function -->
	<script>
		$(document).ready(function(){
		  $('[data-toggle="tooltip"]').tooltip();   
		});
	</script>


  </body>

</html>
