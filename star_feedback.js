function starFeedback(user_name)
{
       $(document).ready(function()
       {
              $("input[type=radio][name=star]").change(function()
              {
                     var rating = this.value;
                     var username = user_name;
                     var tymsg = "Much appreciated! Any feedback?";
                     $.ajax({
                            type: "GET",
                            async: true,
                            url: " feedback_backend.php",
                            data: {"star": rating, "user" : username},
                            success: function(output)
                            {
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
                            error: function(output)
                            {
                                   $('#ratingsForm').html("How was your experience?<h5 style='color:red;'>Something is not right. We\'ll try next time!</h5>").fadeIn(3000).delay(4000).fadeOut("slow");
                            }
                     });
              });

              $('body').on("keypress", "#feedbackTxt", function (e) 
              {
                     if (e.which == 13) 
                     {
                            var feedback = this.value;
                            var username = user_name;
                            $.ajax({
                                   type: "GET",
                                   async: true,
                                   url: " feedback_backend.php",
                                   data: {"feedback": feedback, "user" : username},
                                   success: function(output) 
                                   {
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
                                   error: function(output) 
                                   {
                                          $('#ratingsForm').html("How was your experience?<h5 style='color:red;'>Something is not right. We\'ll try next time!</h5>").fadeIn(3000).delay(4000).fadeOut("slow");
                                   }
                            });
                            e.preventDefault();
                     }
              });

              $('body').on("click", "#nothingtosay", function (e)
              {
                     e.preventDefault();
                     $('#ratingsForm').html("How was your experience?<h5>Alright, not a problem!</h5>").fadeIn(2000).delay(2000).fadeOut("slow");
              });
       });
}