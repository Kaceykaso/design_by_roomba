<?php
date_default_timezone_set('America/Los_Angeles');
$file = "conversation.txt";
// Simple shapes to draw
$keywords = array("circle","square","triangle","line","zigzag","spiral","tree");
// Bob Ross quotes
$quotes = array("You know me, I gotta put in a big tree.","Here's your bravery test!","Any time ya learn, ya gain.","Haha, and just beat the devil out of it.","Clouds are very, very free.","Happy as we can be.","I like to beat the brush.","Talk to the tree, make friends with it.","We don't make mistakes, we just have happy accidents.","You can do anything you want to do. This is your world.","We want happy paintings. Happy paintings. If you want sad things, watch the news.");
$quoteCount = count($quotes);

// Check for user input
if (isset($_POST["chat"])) {
	// Write convo
	$thisChat = $_POST["chat"];
	$userChat = "<div class=\"user\"><p>".$_POST["chat"]."</p></div><div class=\"clear\"></div>";
	addText($userChat);
	// Make everything lowercase
	$thisChat = strtolower($thisChat);
	// Parse user input
	$temp = explode(" ", $thisChat);
	// Strip out weird characters
	$temp = preg_replace('/[.,]+/', '', $temp);
	// Search for keywords
	$parsed = array();
	foreach ($temp as $word) {
		if (in_array($word, $keywords)) {
			$parsed[] = $word;
		}
	}
	if (count($parsed) > 0) {
		$bobChat = "<div class=\"bob\"><p>Oh, I should draw a ".$parsed[0]."?</p></div><div class=\"clear\"></div>";
	} else {
		if (in_array("yes", $temp)) {
			$bobChat = "<div class=\"bob\"><p>Alrighty then.</p></div><div class=\"clear\"></div>";
			$thisQuote = rand(0, $quoteCount);
			$bobChat .= "<div class=\"bob\"><p>".$quotes[$thisQuote]."</p></div><div class=\"clear\"></div>";
		} else if (in_array("no", $temp)) {
			$bobChat = "<div class=\"bob\"><p>Oh ok, then what?</p></div><div class=\"clear\"></div>";
		} else {
			$bobChat = "<div class=\"bob\"><p>I can't draw that. How about a happy little tree?</p></div><div class=\"clear\"></div>";
		}
	}
	addText($bobChat);
	$lastTime = date('h:i:s A');
}


// Check for keywords

// Translate keywords to commands

	// Give feedback that command is being executed
	
	// Give feedback when finished
	
// Give feedback on piece as a whole so far



// If its been a while, chat a bit, say something Bob Ross-ish
function checkTime() {
	$timeStamp = date('h:i:s A');
	return $timeStamp;
}

// Reset
if ($_POST['reset']) {
	if (file_exists($file)) {
		unlink($file);
	}
}
// Conversation
function addText($text) {
	$lastLine = $text."\n";
	file_put_contents("conversation.txt", $lastLine, FILE_APPEND | LOCK_EX);
}
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
    <script type="text/javascript">
	function saveScrollPositions(theForm) {
	
		if(theForm) {
		var scrolly = typeof window.pageYOffset != 'undefined' ? window.pageYOffset : document.documentElement.scrollTop;
		var scrollx = typeof window.pageXOffset != 'undefined' ? window.pageXOffset : document.documentElement.scrollLeft;
		theForm.scrollx.value = scrollx;
		theForm.scrolly.value = scrolly;
		}
	}
	</script>
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
	          	<div class="chat-transcript" id="chat-transcript">
	          			<?php 
				        	if (file_exists($file)) {
					        	$read = file_get_contents($file);
								$chats = explode("\n", $read);
								foreach ($chats as $talk) {
									echo $talk;
								}
				        	} else {
								echo "<div class=\"bob\"><p>Hi there! I'm glad to see you today! What shall we make today?</p></div><div class=\"clear\"></div>";
								$thisQuote = rand(0, $quoteCount);
								echo "<div class=\"bob\"><p>".$quotes[$thisQuote]."</p></div><div class=\"clear\"></div>";
							}
				         ?>
	          	</div>
	          		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" name="form" onsubmit="return saveScrollPositions(this);">
						<input type="hidden" name="scrollx" id="scrollx" value="0" />
						<input type="hidden" name="scrolly" id="scrolly" value="0" />
	          			<input type="text" class="chat" name="chat" placeholder="Draw a circle!" value="">
	          			<input type="submit" name="reset" class="btn btn-default btn-xs" value="Reset">
	          		</form>
	         </div>
         </div>
          	
         <div class="row">
	          <div class="instructions">
	          		RossBot is an artist, but he loves to collaborate! Give RossBot suggestions or directions as to what he should incorporate into his work. You can say things like "Draw a <a class="tag">circle</a>", "Add some <a class="tag">spirals</a>", "Give it a <a class="tag">triangle</a>", or even "Make a <a class="tag">happy little tree</a>". RossBot likes happy things. <a class="tag">Zigzags</a> make him sad.
	          </div>
          </div>

          <footer class="">
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
    <?php
	$scrollx = 0;
	$scrolly = 0;
	if(!empty($_REQUEST['scrollx'])) {
		$scrollx = $_REQUEST['scrollx'];
	}
	
	if(!empty($_REQUEST['scrolly'])) {
		$scrolly = $_REQUEST['scrolly'];
	}
	?>
	<script type="text/javascript">
	window.scrollTo(<?php echo "$scrollx" ?>, <?php echo "$scrolly" ?>);
	var objDiv = document.getElementById("chat-transcript");
	objDiv.scrollTop = objDiv.scrollHeight;
	</script>
  </body>
</html>

