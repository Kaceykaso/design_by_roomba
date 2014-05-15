<?php
// Check for user input
if (isset($_POST["chat"])) {
	// Parse user input
}


// Check for keywords

// Translate keywords to commands

	// Give feedback that command is being executed
	
	// Give feedback when finished
	
// Give feedback on piece as a whole so far


// If its been a while, chat a bit, say something Bob Ross-ish


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Design by Roomba, design by committee by design">
    <meta name="author" content="Kacey Coughlin, kaceycoughlin@mac.com">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Design by Roomba</title>

    <!-- Bootstrap core CSS -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

		<nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
			<div class="container-fluid">
				<!-- Mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="index.html">Design by Roomba</a>
			    </div>
			    <!-- Everything else -->
			    <div class="collapse navbar-collapse">
			      <ul class="nav navbar-nav pull-right">
			      	<li><a href="index.php">Command Mode</a></li>
			        <li><a href="about.html">About</a></li>
			        <li><a href="https://github.com/Kaceykaso/design_by_roomba/tree/gh-pages">Fork Me!</a></li>
			        
			      </ul>
			      
			    </div><!-- end .collapse -->
			</div><!-- end .container -->
		</nav>

		<div class="container-fluid">
          <div class="row">
          	<div class="picture-container">
          		<div class="bob"></div>
          		<div class="preview-window">
          		</div>
          	</div>
          </div>
          
          <div class="row">
	      	<div class="chat-container">
	          	<div class="chat-transcript">
	          			
	          			<div class="bob">
	          				<p>
	          					Welcome, fellow artist!
	          				</p>
	          			</div>
	          			<div class="clear"></div>
	          			<div class="user">
	          				<p>
	          					Draw a happy little tree.
	          				</p>
	          			</div>
	          			<div class="clear"></div>
	          			<div class="bob">
	          				<p>
	          					A happy little tree? Alrighty.
	          				</p>
	          			</div>
	          			<div class="clear"></div>
	          	</div>
	          		<form method="post" action="" role="form">
	          			<input type="text" class="chat" name="chat" placeholder="Draw a circle!" value="">
	          		</form>
	         </div>
         </div>
          	
         <div class="row">
	          <div class="instructions">
	          		RossBot is an artist, but he loves to collaborate! Give RossBot suggestions or directions as to what he should incorporate into his work. You can say things like "Draw a <a class="tag">circle</a>", "Add some <a class="tag">spirals</a>", "Give it a <a class="tag">triangle</a>", or even "Make a <a class="tag">happy little tree</a>". RossBot likes happy things. <a class="tag">Zigzags</a> make him sad.
	          </div>
          </div>

          <footer class="navbar-fixed-bottom">
              <p>A <a href="http://www.kaceycoughlin.com/">Kacey Coughlin</a> joint.</p>
          </footer>

    </div> <!-- end .container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/prefixfree.min.js"></script>
    <script>
    	// Add tags to chat when clicked
    	$(document).on("click", "a.tag", function() { 
    
	    // add selected class
	    $(this).toggleClass('selected');
	    
	    // make a collection of tags
	    var newTag = [];
	    $('a.tag.selected').each(function(){
	                
	        // add value;
	        newTag.push($(this).text());
	    });
	    $('.chat').val(newTag.join(', '));
	    $('.chat').focus(); // Put focus on chat
	    
	    return false;  
	});
	// Submit form when Enter key is hit
	$("input").keypress(function(event) {
	    if (event.which == 13) {
	        event.preventDefault();
	        $("form").submit();
	    }
	});
    </script>
  </body>
</html>

