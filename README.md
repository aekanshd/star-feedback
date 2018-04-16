# star-feedback
I did a lot of digging around the net, and couldn’t find any simple feedback system which uses AJAX and PHP to do your job in a second. So, for everyone out there who wants a simple feedback system from their site users, I hope this comes in handy.

## The Demo

[You can find the demo here](http://aekansh.in/examples/starfeedback.php?who=53).

## How to use?

1. Clone this repository.
2. Place the `ratingsForm` code (found inside the **star_feedback.php** file) wherever you want to display the feedback stars.
3. Import **star_feedback.css** file inside the header of your HTML page.
4. Import **animate.css** by using this code:

   ```HTML
   <link href="https://daneden.github.io/animate.css/animate.min.css" rel="stylesheet">
   ```
5. Import **star_feedback.js** file at the end of the body of your HTML page.
6. Create a script tag after importing the **star_feedback.js** and place this code:
  
   ```JavaScript
   $(document).ready(function() {
      	starFeedback(<?php echo '"' . $_GET['who'] . '"'; ?>);
       });
   ```
       
   The ``starFeedback(string userID)`` takes a string as its parameter. Find a way to pass the userID as a string (ex: "1","52",etc) or just pass a "who" parameter in the URL query (like: "starfeedback.php?who=52") and use a PHP echo script to pass it through the function as shown above. 

7. Place **stars.png** in the same directory as your HTML file.
8. Replace/Add your mySQL database credentials to the **feedback_backend.php** script file by either importing your own **dbconnect.php** by using `include_once("dbconnect.php");` or defining them separately inside the script.
9. Use the **create_tables.sql** file to create a separate table for feedback mechanism. Please ensure that a ``users`` tables already exists and that ``users.user_id`` is a valid column.

That's it, you're done. Enjoy!

## Credits

This wouldn't be possible without:

* [Paul Shan](http://voidcanvas.com/make-simple-star-rating-by-radio-buttons-using-css/)
* [Daniel Eden](https://daneden.github.io/animate.css/)

Usage: You're free to use this code as you like, as long as you credit the above mentioned people (and me!) somewhere in your code or on your website. :)

## The Tutorial

**Note: This tutorial is a part of The AD Blog hosted at [http://aekansh.in/](http://aekansh.in/official_blog/tutorials/website-tutorials/ajax-php-based-simple-feedback-system/)**

Okay, so first of all, let me tell you what you NEED to know. To be honest, you can just get away with copy-pasting the codes I’ll be providing you with and the system will work just fine, but to really understand the stuff that’s happening, you’ll need to know [HTML5](http://www.w3schools.com/html/html5_intro.asp), [JAVASCRIPT](http://www.w3schools.com/js/default.asp), [JQUERY](http://www.w3schools.com/jquery/) (particularly [AJAX](http://api.jquery.com/jquery.ajax/)), [PHP](http://www.w3schools.com/php/) and a bit of [CSS](http://www.w3schools.com/css/).

So, let’s get started. We’ll do the database first, since that’s easy – ya know. So go ahead, create a new table called “ratings” with 4 columns – rating_id (INT[size 11] AUTO_INCREAMENT NOT_NULL PRIMARY), rating (INT[size 5] NOT_NULL), feedback (TEXT NULL), by_user (INT INDEX NOT_NULL).

| FIELD        | TYPE           | NULL  | KEY | DEFAULT | Extra |
|:-------------:|:-------------:|:-----:|:-----:|:-----:|:-----:|
| rating_id	| INT[11]	|	| Primary |	|	auto_increment
| rating	| INT[5] | | | | |				
| feedback |	TEXT	| YES | | | |			
| by_user	| INT	| |	Index	| | |

To make your job easier, here’s the code to make the table:

```SQL
CREATE TABLE `ratings` (
 `rating_id` int(11) NOT NULL AUTO_INCREMENT,
 `rating` int(5) NOT NULL,
 `feedback` text,
 `by_user` int(11) NOT NULL,
 PRIMARY KEY (`rating_id`),
 KEY `by_user` (`by_user`),
 CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`by_user`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
```

Note that `ratings`.`by_user` is in a relation with `users`.`user_id` which is another table containing the users’ data. We need a foreign key to make sure we know **who** is giving the rating. You can make it anonymous, but it’s usually alright to know who gave you that shitty (or even awesome) rating.

In case you don’t want to do that, just use this code:

```SQL
CREATE TABLE `ratings` (
 `rating_id` int(11) NOT NULL AUTO_INCREMENT,
 `rating` int(5) NOT NULL,
 `feedback` text,
 `by_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1
```

Now that the database is ready, we can get ready to make the front end. We will start off by make the stars! Alright, so I would like to tell you that this code for the styling of the stars is not mine, but is [Paul Shan](http://voidcanvas.com/make-simple-star-rating-by-radio-buttons-using-css/)‘s idea!

Here’s the HTML part of it:

```HTML
<form id="ratingsForm" class="animated zoomInUp">
 How was your experience?<br>
  <div class="stars" role="form">
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
```

And then here’s the CSS part of it:

```CSS
form .stars {
  background: url("stars.png") repeat-x 0 0;
  width: 150px;
  margin: 0 auto;
}
 
form .stars input[type="radio"] {
  position: absolute;
  opacity: 0;
  filter: alpha(opacity=0);
}
form .stars input[type="radio"].star-5:checked ~ span {
  width: 100%;
}
form .stars input[type="radio"].star-4:checked ~ span {
  width: 80%;
}
form .stars input[type="radio"].star-3:checked ~ span {
  width: 60%;
}
form .stars input[type="radio"].star-2:checked ~ span {
  width: 40%;
}
form .stars input[type="radio"].star-1:checked ~ span {
  width: 20%;
}
form .stars label {
  display: block;
  width: 30px;
  height: 30px;
  margin: 0!important;
  padding: 0!important;
  text-indent: -999em;
  float: left;
  position: relative;
  z-index: 10;
  background: transparent!important;
  cursor: pointer;
}
form .stars label:hover ~ span {
  background-position: 0 -30px;
}
form .stars label.star-5:hover ~ span {
  width: 100% !important;
}
form .stars label.star-4:hover ~ span {
  width: 80% !important;
}
form .stars label.star-3:hover ~ span {
  width: 60% !important;
}
form .stars label.star-2:hover ~ span {
  width: 40% !important;
}
form .stars label.star-1:hover ~ span {
  width: 20% !important;
}
form .stars span {
  display: block;
  width: 0;
  position: relative;
  top: 0;
  left: 0;
  height: 30px;
  background: url("stars.png") repeat-x 0 -60px;
  -webkit-transition: -webkit-width 0.5s;
  -moz-transition: -moz-width 0.5s;
  -ms-transition: -ms-width 0.5s;
  -o-transition: -o-width 0.5s;
  transition: width 0.5s;
}
```

But wait, you still can’t see the stars! Hmm… what happened? It’s because of the “star.png” file which you do not have! Make sure you insert [this image](https://raw.githubusercontent.com/aekanshd/star-feedback/master/stars.png) in the same directory as the css file! (just right click, and save the image!)

Now, you can see your stars! Yay! But how will you make the rating actually work? Well, for that we’ll need a bit of JQuery and a bit of PHP. So, let’s get to it!

In the same HTML file in which you have your stars placed, write this Javascript code inside a <script> tag:
  
```JavaScript
 $(document).ready(function() {
 $("input[type=radio][name=star]").change(function() {
 var rating = this.value;
 <?php echo 'var username = "' . $_GET['who'] . '";'; ?>
 var tymsg = "Much appreciated! Any feedback?";
 $.ajax({
 type: "GET",
 async: true,
 url: "rating_backend.php",
 data: {"star": rating, "user" : username},
 success: function(output) {
 var json = eval('('+ output + ')');
 var responseMsg = json['status'];
 if(responseMsg=="success")
 {
 switch(rating)
 {
 case "1":
 tymsg = "Well, that's okay. Where can we improve?";
 break;
 case "5":
 tymsg = "Awesome! Thank you so much!";
 $("#ratingsForm").removeClass('animated zoomInUp').addClass('animated tada');
 }
 if(rating == "5")
 {
 $('#ratingsForm').html("How was your experience?<h5>" + tymsg + "</h5>").fadeIn(3000).delay(3000).fadeOut("slow");
 }
 else
 {
 $('#ratingsForm').html('How was your experience?<h5 style="margin-bottom:3px;">' + tymsg + '</h5><div class="row" style="margin-bottom:3px;"><div class="col-xs-2"></div><div class="col-xs-8" style="margin-top:10px;"><input style="height:2em;" class="form-control input-sm" id="feedbackTxt" placeholder="Any suggestions? Enter to submit." type="text" data-toggle="tooltip" title="Press enter to submit." data-placement="bottom"></div><div class="col-xs-2"></div></div><a href="" id="nothingtosay" >Click here to skip the feedback.</a>');//.fadeIn(3000).delay(1000).fadeOut("slow");
 }
 
 }
 else
 {
 $('#ratingsForm').html("How was your experience?<h5 style='color:red;'>" + responseMsg + "</h5>").fadeIn(3000).delay(4000).fadeOut("slow");
 }
 },
 error: function(output) {
 $('#ratingsForm').html("How was your experience?<h5 style='color:red;'>Something is not right. We\'ll try next time!</h5>").fadeIn(3000).delay(4000).fadeOut("slow");
 }
 });

 });
 $('body').on("keypress", "#feedbackTxt", function (e) {
 if (e.which == 13) {
 var feedback = this.value;
 <?php echo 'var username = "' . $_GET['who'] . '";'; ?>
 $.ajax({
 type: "GET",
 async: true,
 url: "rating_backend.php",
 data: {"feedback": feedback, "user" : username},
 success: function(output) {
 var json = eval('('+ output + ')');
 var responseMsg = json['status'];
 if(responseMsg == "success")
 {
 $('#ratingsForm').html("How was your experience?<h5>That's it! Thank you.</h5>").fadeIn(2000).delay(2000).fadeOut("slow");
 }
 else
 {
 $('#ratingsForm').html("How was your experience?<h5 style='color:red;'>" + responseMsg + "</h5>").fadeIn(3000).delay(4000).fadeOut("slow");
 }
 },
 error: function(output) {
 $('#ratingsForm').html("How was your experience?<h5 style='color:red;'>Something is not right. We\'ll try next time!</h5>").fadeIn(3000).delay(4000).fadeOut("slow");
 }
 });
 e.preventDefault();
 }
 });
 $('body').on("click", "#nothingtosay", function (e) {
 e.preventDefault();
 $('#ratingsForm').html("How was your experience?<h5>Alright, not a problem!</h5>").fadeIn(2000).delay(2000).fadeOut("slow");
 });
 });
```

As you must have noticed, I am using [Bootstrap Framework](http://getbootstrap.com/) and also a bit of PHP **inside** Javascript. Let me explain what happens here. The php script basically defines a Javascript variable called ‘username’ which has the user ID of the person who’s giving the feedback. This username can be echo’d from any source – database, session variables, post and get variables, etc. In my case, I am using it from the _GET method. This basically means that I am assuming that my URL address of this page will have a variable called ‘who’ passed along with it in the URL.
Something like: http://mywebsite.net/feedback.php?who=2

Where ‘2‘ is the same value that will be stored in the ‘by_user’ field of the ratings table in our database! Well, you can of course change how this works, but let’s just stick to this for now.

**One thing to keep in mind is this script requires you to add Jquery to your page. To add that, use this piece of code and place it above (or before) the script you have written above:**

```HTML
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
```

Once that is done, let us understand what else happens in that script. Basically, every time someone clicks a star, an AJAX GET request is sent to the server and the fetched result is appropriately displayed on the website. This means that everything happens without the page actually “refreshing”.

Next create another file called **rating_backend.php** and write this code there:

```PHP
<?php
include_once 'dbconnect.php'; //or your code to connect to your database

if(isset($_GET['star']) && isset($_GET['user']))
{
 $rating = $_GET['star'];
 $user_id = $_GET['user'];
 $ratingq = mysql_query("INSERT INTO `ratings` (`rating_id`, `rating`, `feedback`, `by_user`) VALUES (NULL, '" . $rating . "', " . (($rating==5)?"'User gave 5 stars.'":"NULL") . ", '" . $user_id . "')");

 if(mysql_affected_rows()>= 0)
 {
 $response_array['status'] = "success";
 }
 else
 {
 $response_array['status'] = "Oops. Something went wrong. We'll try that next time! Promise.";
 }
}
else if(isset($_GET['feedback']) && isset($_GET['user']))
{
 $feedback = mysql_escape_string($_GET['feedback']);
 $user_id = $_GET['user'];
 $ratingq = mysql_query("UPDATE `ratings` SET `feedback` = '" . $feedback . "' WHERE `by_user` = '" . $user_id . "'");

 if(mysql_affected_rows()>= 0)
 {
 $response_array['status'] = "success";
 }
 else
 {
 $response_array['status'] = "Oops. Something went wrong. We'll try that next time! Promise.";
 }
}

echo json_encode($response_array);
?>
```

Our back-end script will generate a JSON response which will then be read by the feedback page, and then it will be evaluated. If the status was a “success”, then appropriate steps will be taken, else an error message will be shown. We have already handled all this in our AJAX request!

Technically, that’s it! But, to add more “decoration” go ahead and add this file to head of the page which uses the feedback!

```HTML
<link href="https://daneden.github.io/animate.css/animate.min.css" rel="stylesheet">
```
This is just to add the animations! If this doesn’t work, you can go ahead the download the file from [here](https://daneden.github.io/animate.css/), and make sure import the file onto the page correctly!

I guess that was the last step, and now you’re all set. Go ahead and see what your users think of you! All the best!
