<?php
date_default_timezone_set('America/Los_Angeles');
// Save transcript of conversation
$file = "conversation.txt";
// Simple shapes to draw
$keywords = array("circle","square","triangle", "line", "spiral", "tree");
// Bob Ross quotes
$quotes = array("You know me, I gotta put in a big tree.","Here's your bravery test!","Any time ya learn, ya gain.","Haha, and just beat the devil out of it.","Clouds are very, very free.","Happy as we can be.","I like to beat the brush.","Talk to the tree, make friends with it.","We don't make mistakes, we just have happy accidents.","You can do anything you want to do. This is your world.","We want happy paintings. Happy paintings. If you want sad things, watch the news.");
$quoteCount = count($quotes);

// Check for user input
if (isset($_POST["chat"])) {
	// Write convo
	$thisChat = $_POST["chat"];
	$userChat = "<div class=\"user\"><p>".$_POST["chat"]."</p></div><div class=\"clear\"></div>";
	addText($userChat);
	$bobChat = "";
	// Make everything lowercase
	$thisChat = strtolower($thisChat);
	// Parse user input
	$temp = explode(" ", $thisChat);
	// Strip out weird characters
	$temp = preg_replace('/[.,?!&*_;]+/', '', $temp);
	// Search for keywords
	$parsed = array();
	foreach ($temp as $word) {
		if (in_array($word, $keywords)) {
			$parsed[] = $word;
		}
	}
	$total_parsed = count($parsed);
	
	// If anything is parsed, do something	
	if ($total_parsed > 0) {
		$alt_bob = "painting";
		$bobChat .= "<div class=\"bob\"><p>Alrighty then, let's make a ";
		// List all parsed keywords
		for ($i = 0; $i < $total_parsed; $i++) {
			$bobChat .= $parsed[$i];
			if ($i == $total_parsed-1) {
				$bobChat .= ".";
			} else {
				$bobChat .= ", and then a ";
			}
		}
		$bobChat .= "</p></div><div class=\"clear\"></div>";
		$command = "";
		// Chain as many commands as needed
		for ($i = 0; $i < $total_parsed; $i++) {
			$command .= "python python/".$parsed[$i].".py";
			if ($parsed[$i] == "line") { addLine(); }
			if ($parsed[$i] == "spiral") { addSpiral(); }
			if ($parsed[$i] == "square") { addSquare(); }
			if ($parsed[$i] == "triangle") { addTriangle(); }
			// Check if current shape is a circle, follow up with stop command if so
			if ($parsed[$i] == "circle") {
				addCircle();
				sleep(1);
				$command .= " && python python/stop.py";
			}
			// Check if this is the last one, if not, add more
			if ($i == $total_parsed-1) {
				$command .= "";
			} else {
				$command .= " && ";
			}
		}
		system($command);
		$thisQuote = rand(0, $quoteCount);
		
		// Check number of each shape drawn so far, respond in kind
		if (getCircle() > 4) {
			$alt_bob = "upset";
			$bobChat .= "<div class=\"bob\"><p>I SAID SOMETHING NEW! I'm adding a triangle!</p></div><div class=\"clear\"></div>";
			addTriangle();
			$command = "python python/triangle.py";
			system($command);
			file_put_contents("circle.txt", 0); // reset
		} else if (getCircle() > 3) {
			$alt_bob = "unsure";
			$bobChat .= "<div class=\"bob\"><p>That's a lot of circles! Maybe something new next time?</p></div><div class=\"clear\"></div>";
		} else {
			$alt_bob = "painting";
		}
		
		if (getLine() > 4) {
			$alt_bob = "upset";
			$bobChat .= "<div class=\"bob\"><p>I SAID SOMETHING NEW! I'm adding a spiral!</p></div><div class=\"clear\"></div>";
			addSpiral();
			$command = "python python/spiral.py";
			system($command);
			file_put_contents("line.txt", 0); // reset
		} else if (getLine() > 3) {
			$alt_bob = "unsure";
			$bobChat .= "<div class=\"bob\"><p>That's a lot of lines! Maybe something new next time?</p></div><div class=\"clear\"></div>";
		}
		
		if (getSpiral() > 4) {
			$alt_bob = "upset";
			$bobChat .= "<div class=\"bob\"><p>I SAID SOMETHING NEW! I'm adding a circle!</p></div><div class=\"clear\"></div>";
			addCircle();
			$command = "python python/circle.py";
			system($command);
			file_put_contents("spiral.txt", 0); // reset
		} else if (getSpiral() > 3) {
			$alt_bob = "unsure";
			$bobChat .= "<div class=\"bob\"><p>That's a lot of spirals! Maybe something new next time?</p></div><div class=\"clear\"></div>";
		}
		
		if (getSquare() > 4) {
			$alt_bob = "upset";
			$bobChat .= "<div class=\"bob\"><p>I SAID SOMETHING NEW! I'm adding a line!</p></div><div class=\"clear\"></div>";
			addLine();
			$command = "python python/line.py";
			system($command);
			file_put_contents("square.txt", 0); // reset
		} else if (getSquare() > 3) {
			$alt_bob = "unsure";
			$bobChat .= "<div class=\"bob\"><p>That's a lot of squares! Maybe something new next time?</p></div><div class=\"clear\"></div>";
		}
		
		if (getTriangle() > 4) {
			$alt_bob = "upset";
			$bobChat .= "<div class=\"bob\"><p>I SAID SOMETHING NEW! I'm adding a square!</p></div><div class=\"clear\"></div>";
			addSquare();
			$command = "python python/square.py";
			system($command);
			file_put_contents("triangle.txt", 0); // reset
		} else if (getTriangle() > 3) {
			$alt_bob = "unsure";
			$bobChat .= "<div class=\"bob\"><p>That's a lot of triangles! Maybe something new next time?</p></div><div class=\"clear\"></div>";
		}
		
		// Other responses
		$alt_bob = "";
		if (in_array("tree", $temp)) {$bobChat .= "<div class=\"bob\"><p>I really love trees, great choice!</p></div><div class=\"clear\"></div>";}
		$bobChat .= "<div class=\"bob\"><p>".$quotes[$thisQuote]."</p></div><div class=\"clear\"></div>";
	} else {
		if (in_array("imperial", $temp)) {
			$alt_bob = "stormtrooper";
			$bobChat = "<div class=\"bob\"><p>Lord Vader has no interest in your puny demands.</p></div><div class=\"clear\"></div>";
			system('python python/imperial_march.py');
		} else if (in_array("test", $temp)) {
			$alt_bob = "";
			$bobChat = "<div class=\"bob\"><p>Running test script.</p></div><div class=\"clear\"></div>";
			system('python python/test2.py');
		} else if (in_array("love", $temp)) {
			$alt_bob = "love";
			$bobChat = "<div class=\"bob\"><p>What do I love? I love trees!</p><p>Happy little trees.</p></div><div class=\"clear\"></div>";
		} else if (in_array("hello", $temp)) {
			$alt_bob = "";
			$bobChat = "<div class=\"bob\"><p>Hello there!</p></div><div class=\"clear\"></div>";
			$command = "python python/hello.py";
			system($command);
		} else {
			$bobChat = "<div class=\"bob\"><p>I can't draw that. How about a happy little tree?</p></div><div class=\"clear\"></div>";
			$alt_bob = "";
		}

	}
	// Give response
	addText($bobChat);
}

// Reset
if ($_POST['reset']) {
	if (file_exists($file)) { unlink($file); }
	file_put_contents("circle.txt", 0);
	file_put_contents("line.txt", 0);
	file_put_contents("spiral.txt", 0);
	file_put_contents("square.txt", 0);
	file_put_contents("triangle.txt", 0);
}
// Conversation
function addText($text) {
	$lastLine = $text."\n";
	file_put_contents("conversation.txt", $lastLine, FILE_APPEND | LOCK_EX);
}
// Get counts 
function getCircle() { return (int)file_get_contents("circle.txt"); }
function getLine() { return (int)file_get_contents("line.txt"); }
function getSpiral() { return (int)file_get_contents("spiral.txt"); }
function getSquare() { return (int)file_get_contents("square.txt"); }
function getTriangle() { return (int)file_get_contents("triangle.txt"); }
// Records counts
function addCircle() {
	$circleCount = getCircle() + 1;
	file_put_contents("circle.txt", $circleCount);
}
function addLine() {
	$lineCount = getLine() + 1;
	file_put_contents("line.txt", $lineCount);
}
function addSpiral() {
	$spiralCount = getSpiral() + 1;
	file_put_contents("spiral.txt", $spiralCount);
}
function addSquare() {
	$squareCount = getSquare() + 1;
	file_put_contents("square.txt", $squareCount);
}
function addTriangle() {
	$triangleCount = getTriangle() + 1;
	file_put_contents("triangle.txt", $triangleCount);
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
    	// Save scroll position of page after refresh
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
			        <li><a href="https://github.com/Kaceykaso/design_by_roomba/tree/gh-pages/blog">About</a></li>
			        <li><a href="https://www.youtube.com/playlist?list=PLWnhVchApyJveY8cioEd4EkjYBgywtLct">Videos</a></li>
			        <li><a href="https://github.com/Kaceykaso/design_by_roomba/tree/gh-pages">Fork Me!</a></li>
			        
			      </ul>
			      
			    </div><!-- end .collapse -->
			</div><!-- end .container -->
		</nav>

		<div class="container-fluid">
          <div class="row">
          	<div class="picture-container">
          		<div class="bob <?php echo $alt_bob; ?>"></div>
          	</div>
          </div>
          
          <div class="row">
	      	<div class="chat-container">
	          	<div class="chat-transcript" id="chat-transcript">
	          			<?php  // Read conversation and display
				        	if (file_exists($file)) {
					        	$read = file_get_contents($file);
								$chats = explode("\n", $read);
								foreach ($chats as $talk) {
									echo $talk;
								}
				        	} else {
								echo "<div class=\"bob\"><p>Hi there! I'm glad to see you today! What shall we make today?</p></div><div class=\"clear\"></div>";
								$thisQuote = rand(0, $quoteCount-1);
								echo "<div class=\"bob\"><p>".$quotes[$thisQuote]."</p></div><div class=\"clear\"></div>";
							}
				         ?>
	          	</div>
	          		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" name="form" onsubmit="return saveScrollPositions(this);">
						<input type="hidden" name="scrollx" id="scrollx" value="0" />
						<input type="hidden" name="scrolly" id="scrolly" value="0" />
	          			<input type="text" class="chat" name="chat" placeholder="Draw a circle!" value="">
	          			<input type="submit" name="submit" class="btn btn-primary btn-xs" value="Go!">
	          			<input type="submit" name="reset" class="btn btn-default btn-xs" value="Reset">
	          		</form>
	         </div>
         </div>
          	
         <div class="row">
	          <div class="instructions">
	          	RossBot is an artist, but he loves to collaborate! Give RossBot suggestions or directions as to what he should incorporate into his work. You can say things like "Draw a <a class="tag">circle</a>s", "Add some <a class="tag">spiral</a>s", "Give it a <a class="tag">triangle</a>", or even "Make a <a class="tag">happy little tree</a>". RossBot likes happy things. <a class="tag">Zigzag</a>'s make him sad.
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
    	// More scroll-saving stuffs
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
	// EVEN MOAR scroll-saving stuffs
	window.scrollTo(<?php echo "$scrollx" ?>, <?php echo "$scrolly" ?>);
	var objDiv = document.getElementById("chat-transcript");
	objDiv.scrollTop = objDiv.scrollHeight;
	</script>
  </body>
</html>

