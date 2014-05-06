<!DOCTYPE html>
<html lang="en">
  <head>
  
  </head>
  <body>
<h3 id="countdown">
	<span id="minute"></span>:<span id="second"></span>
</h3>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
var sec = 30;
var minute = 1;
$("#minute").text(minute);
$("#second").text(sec);
function countdown(){
		  if (minute > 0) {
		    if (sec > 0) {
		      sec--;
		      if (sec <= 10) {
		        $('#second').text('0'+sec);
		      } else {
		        $('#second').text(sec);
		      }
		      
		    } else {
		      minute--;
		      $('#minute').text(minute);
		      sec = 59;
		    }
		  } else if (minute == 0) {
		    $('#minute').fadeOut(500);
		    if (sec > 0 ) {
		      sec--;
		      if (sec <= 10) {
		        $('#second').text('0'+sec);
		        $('#second').fadeOut(300);
		        $('#second').fadeIn(300);
		      } else {
		        $('#second').text(sec);
		      }
		    } else if (sec == 0) {
		      $('#countdown #second').fadeOut(500);
		      $('#countdown').fadeOut(500);
		      $('#reset').submit();
		    } //seconds
		  } //minutes
		}
setInterval("countdown()",1000);
</script>
  </body>
</html>