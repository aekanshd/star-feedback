<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>AJAX based Feedback Example | Aekansh Dixit</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="star_feedback.css" rel="stylesheet">
    <link href="https://daneden.github.io/animate.css/animate.min.css" rel="stylesheet">
    </head>

  <body>

    <div class="container">

      <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8" style="text-align:center;">
        <h1>Feedback Demo</h1><br>
          <form id="ratingsForm" class="animated zoomInUp">
           <centeR>How was your experience?<br>
           <div class="stars" role="form" style="text-align:left;">
             <input type="radio" name="star" class="star-1 showstar" id="star-1" value="1" />
             <label class="star-1" for="star-1">1</label>
             <input type="radio" name="star" class="star-2 showstar" id="star-2" value="2" />
             <label class="star-2" for="star-2">2</label>
             <input type="radio" name="star" class="star-3 showstar" id="star-3" value="3" />
             <label class="star-3" for="star-3">3</label>
             <input type="radio" name="star" class="star-4 showstar" id="star-4" value="4" />
             <label class="star-4" for="star-4">4</label>
             <input type="radio" name="star" class="star-5 showstar" id="star-5" value="5" />
             <label class="star-5" for="star-5">5</label>
             <span></span>
           </div>
         </form>
           </div>
      <div class="col-sm-2"></div>  
      </div>

           <br><Br><center><h3>Note: This is a demo. Your ratings will not be actually stored!</h3><br>This is a demo for the post <a target="_blank" href="http://aekansh.in/official_blog/tutorials/ajax-php-based-simple-feedback-system/">Simple AJAX Feedback</a> made on Aekansh's official blog. All rights reserved.
           <br><br><a href="star_feedback.php?who=68">Restart the demo</a> | View <a href="backend_source.php" target="_blank">Back-end</a> source.</center></div>
    <!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="star_feedback.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
      	starFeedback(<?php echo '"' . $_GET['who'] . '"'; ?>);
       });
    </script>
  </body>
</html>

<!--
Copyright Aekansh Dixit, 2016.
-->
