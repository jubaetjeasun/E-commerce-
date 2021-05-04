<!DOCTYPE html>
<html lang="en">

 <head>
<title>Fresh Food</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="e-commerce site well design with responsive view." />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="css/stylesheet.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
<link href="owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" media="screen" />
<script src="javascript/jquery-2.1.1.min.js" ></script>
<script src="bootstrap/js/bootstrap.min.js" ></script>
<script src="javascript/jstree.min.js" ></script>
<script src="javascript/template.js"  ></script>
<script src="javascript/common.js" ></script>
<script src="javascript/global.js" ></script>
<script src="owl-carousel/owl.carousel.min.js" ></script>
</head>
<body>
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
 
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?> 
<div class="mainbanner">
  <div id="main-banner" class="owl-carousel home-slider">
     <div class="item"> <a href="#"><img src="image/banners/Main-Banner2.jpg" alt="main-banner2" class="img-responsive" /></a> </div>
    <div class="item"> <a href="#"><img src="image/banners/Main-Banner3.jpg" alt="main-banner3" class="img-responsive" /></a> </div>
  </div>
</div>
<div class="container">
  <div class="row">
  
    <div class="cms_banner ">
      <div class="col-md-4 cms-banner-left"> <a href="#"><img alt="#" src="image/banners/subbanner1.jpg"></a> </div>
      <div class="col-md-4 cms-banner-middle">
        <div class="md1"><a href="#"> <img alt="#" src="image/banners/subbanner2.jpg"></a> </div>
        <div class="md2"><a href="#"> <img alt="#" src="image/banners/subbanner2-1.jpg"></a></div>
      </div>
      <div class="col-md-4 cms-banner-right"> <a href="#"><img alt="#" src="image/banners/subbanner3.jpg"></a> </div>
    </div>
  </div>
  <div class="row">
    <div id="content" class="col-sm-12">
      <div class="customtab">
        
        
       
   
    
      </div>
      <div class="parallax">
        <ul id="testimonial" class="row owl-carousel product-slider">
          <li class="item">
            <div class="panel-default">
              <div class="testimonial-desc">Rem ipsum doLorem ipsum ut Rem ipsum doLorem ipsum ut labore et dolore malabore et dolore maipsum doLorem ipsum ut labore et dolore magna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur adipisicing</div>
              <div class="testimonial-image"><img src="image/t1.jpg" alt="#"></div>
              <div class="testimonial-name"><h2>Martin</h2></div>
              <div class="testimonial-designation"><p>Job Holder</p></div>

            </div>
          </li>

          <li class="item">
            <div class="panel-default">
              <div class="testimonial-desc">Rem ipsum doLoremRem ipsum doLorem ipsum ut labore et dolore ma ipsum ut labore et dolore  Rem ipsum doLorem ipsum ut labore et dolore mamagna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur adipisicing</div>
              <div class="testimonial-image"><img src="image/t2.jpg" alt="#"></div>
              <div class="testimonial-name"><h2>Lisa</h2></div>
              <div class="testimonial-designation"><p>Job Holder</p></div>

            </div>
          </li>
          <li class="item">
            <div class="panel-default">
              <div class="testimonial-desc">RemRem ipsum doLorem ipsum ut labore et dolore ma ipsum doLorem ipsum ut labore et dolore magna.Rem ipsum doLorem ipsum ut labore et dolore maLorem ipsum doLorem ipsum dolor sit amet, consectetur adipisicing</div>
              <div class="testimonial-image"><img src="image/t3.jpg" alt="#"></div>
              <div class="testimonial-name"><h2>Mack</h2></div>
              <div class="testimonial-designation"><p>Businessman</p></div>

            </div>
          </li>
          
       
        </ul>
      </div>
      <div class="row">
        <div class="cms_banner">
          <div class="col-md-4 cms-banner-left"> <a href="#"><img alt="#" src="image/banners/subbanner5.jpg"></a> </div>
          <div class="col-md-4 cms-banner-middle"> <a href="#"><img alt="#" src="image/banners/subbanner6.jpg"></a> </div>
          <div class="col-md-4 cms-banner-right"> <a href="#"><img alt="#" src="image/banners/subbanner7.jpg"></a> </div>
        </div>
      </div>
      <div id="subbanner4" class="banner" >
        <div class="item"> <a href="#"><img src="image/banners/subbanner4.jpg" alt="Sub Banner4" class="img-responsive" /></a> </div>
      </div>
       
       
       
       
    </div>
  </div>
</div> 
<?php include('includes/footer.php')?>
<script src="javascript/parally.js"></script> 
<script>
$('.parallax').parally({offset: -40});
</script>
</body>

 </html>
