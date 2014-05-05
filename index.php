<?php
// Check clicks
if (isset($_POST['btnForward'])) {
	addForward();
	addClicked("up");
}
if (isset($_POST['btnLeft'])) {
	addLeft();
	addClicked("left");
}
if (isset($_POST['btnRight'])) {
	addRight();
	addClicked("right");
}
if (isset($_POST['btnBackward'])) {
	addBackward();
	addClicked("down");
}

// Read back counts
function getForward() {
	return (int)file_get_contents("forward.txt");
}
function getLeft() {
	return (int)file_get_contents("left.txt");
}
function getRight() {
	return (int)file_get_contents("right.txt");
}
function getBackward() {
	return (int)file_get_contents("backward.txt");
}
function getLastClicked($index) {
	if (file_exists("clicked.txt")) {
		$temp = file_get_contents("clicked.txt");
		$temp2 = explode("\n", $temp);
		$all_clicked = array_reverse($temp2);
		$clicked = array_slice($all_clicked, 0, 6);
		return $clicked[$index];
	}
}

// Record counts
function addForward() {
	$forwardCount = getForward() + 1;
	file_put_contents("forward.txt", $forwardCount);
}
function addLeft() {
	$leftCount = getLeft() + 1;
	file_put_contents("left.txt", $leftCount);
}
function addRight() {
	$rightCount = getRight() + 1;
	file_put_contents("right.txt", $rightCount);
}
function addBackward() {
	$backCount = getBackward() + 1;
	file_put_contents("backward.txt", $backCount);
}
// Record all
function addClicked($direction) {
	$lastClicked = $direction."\n";
	file_put_contents("clicked.txt", $lastClicked, FILE_APPEND | LOCK_EX);
}

// Reset all counts
if (isset($_POST['reset'])) {
	 file_put_contents("forward.txt", 0);
	 file_put_contents("left.txt", 0);
	 file_put_contents("right.txt", 0);
	 file_put_contents("backward.txt", 0);
	 file_put_contents("clicked.txt", "");
}

// Get max,min values
$up = getForward();
$down = getBackward();
$left = getLeft();
$right = getRight();
$values = array($up,$down,$left,$right);
$first = max($values);
$last = min($values);

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
			        <li class="active"><a href="about.html">About</a></li>
			        <li><a href="https://github.com/Kaceykaso/design_by_roomba/tree/gh-pages">Fork Me!</a></li>
			        <!--<li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
			          <ul class="dropdown-menu">
			            <li><a href="#">Action</a></li>
			            <li><a href="#">Another action</a></li>
			            <li><a href="#">Something else here</a></li>
			            <li class="divider"></li>
			            <li><a href="#">Separated link</a></li>
			            <li class="divider"></li>
			            <li><a href="#">One more separated link</a></li>
			          </ul>
			        </li>-->
			      </ul>
			      
			    </div><!-- end .collapse -->
			</div><!-- end .container -->
		</nav>

		<div class="container-fluid">
          <div class="row main">
          
          	<div class="col-xs-8 col-sm-6 col-md-4">
          		<div class="graph">
          			
		          	<div class="graph-container">
			          	<!-- Labels -->
		          		<div class="bar-container graph-labels">
		          			<p>100%</p>
		          			<p>50%</p>
		          			<p>0%</p>
		          		</div>
		          		<!-- Right -->
		          		<div class="bar-container commandRight">
		          			<div class="bar
		          			<?php if ($left == $first) {echo " first";}
		          				else if ($left == $last) {echo " last";} ?>
		          			" style="height: <?php echo getLeft(); ?>%;">
		          			</div>
		          			<?php echo getLeft(); ?>
		          		</div>
		          		<!-- Up -->
		          		<div class="bar-container commandUp">
		          			<div class="bar
		          			<?php if ($up == $first) {echo " first";}
		          				else if ($up == $last) {echo " last";} ?>
		          			" style="height: <?php echo getForward(); ?>%;">
		          			</div>
		          			<?php echo getForward(); ?>
		          		</div>
		          		<!-- Down -->
		          		<div class="bar-container commandDown">
		          			<div class="bar
		          			<?php if ($down == $first) {echo " first";}
		          				else if ($down == $last) {echo " last";} ?>
		          			" style="height: <?php echo getBackward(); ?>%;">
		          			</div>
		          			<?php echo getBackward(); ?>
		          		</div>
		          		<!-- Left -->
		          		<div class="bar-container commandLeft">
		          			<div class="bar
		          			<?php if ($right == $first) {echo " first";}
		          				else if ($right == $last) {echo " last";} ?>
		          			" style="height: <?php echo getRight(); ?>%;">
		          			</div>
		          			<?php echo getRight(); ?>
		          		</div>
		          	</div><!-- end .graph-container -->
		          	<div class="bar-labels">
		          			<i></i>
		          			<i class="fa fa-arrow-left <?php if (getLastClicked(1) == "left") {echo "justClicked";}?>"></i>
		          			<i class="fa fa-arrow-up <?php if (getLastClicked(1) == "up") {echo "justClicked";}?>"></i>
		          			<i class="fa fa-arrow-down <?php if (getLastClicked(1) == "down") {echo "justClicked";}?>"></i>
		          			<i class="fa fa-arrow-right <?php if (getLastClicked(1) == "right") {echo "justClicked";}?>"></i>
		          		</div>
          		</div><!-- end .graph -->
          	</div><!-- end .col -->
          	
	          <div class="col-xs-8 col-sm-6 col-md-4 middle">
	            <h3 class="heading">Which way<br><small>my master?</small></h3>
	            <br>
	            <form role="form" action="" method="post">
	            	<div class="form-group">
	            		<button type="submit" name="btnForward" class="btn btn-lg btn-success" value="forward"><i class="fa fa-arrow-up"></i></button>
	            	</div>
	            	<div class="form-group">
	            		<button type="submit" name="btnLeft" class="btn btn-lg btn-primary" value="left"><i class="fa fa-arrow-left"></i></button>
	            		<button type="submit" name="btnRight" class="btn btn-lg btn-info" value="right"><i class="fa fa-arrow-right"></i></button>
	            	</div>
	            	<div class="form-group">
	            		<button type="submit" name="btnBackward" class="btn btn-lg btn-warning" value="backward"><i class="fa fa-arrow-down"></i></button>
	            	</div>
	            	<button type="submit" name="reset" class="btn btn-lg">Reset</button>
	            </form>
	          </div><!-- end .col -->
	          
	          <div class="col-xs-8 col-sm-12 col-md-4 feedback">
	          <?php if (getLastClicked(1) == "") { ?>
		          <i class="fa fa-spinner fa-spin fa-5x"></i><br>
		          <p class="lead text-center">
		          Waiting for commands:
	          	</p>
	          <?Php } else { ?>
		          <i class="fa fa-arrow-<?php echo getLastClicked(5); ?> fa-5x"></i>
		          <i class="fa fa-arrow-<?php echo getLastClicked(4); ?> fa-5x"></i>
		          <i class="fa fa-arrow-<?php echo getLastClicked(3); ?> fa-5x"></i>
		          <i class="fa fa-arrow-<?php echo getLastClicked(2); ?> fa-5x"></i>
		          <i class="fa fa-arrow-<?php echo getLastClicked(1); ?> fa-5x"></i>
		      <?php } ?>
	          </div>
	          
          </div><!-- end .row -->

          <footer class="navbar-fixed-bottom">
              <p>A <a href="http://www.kaceycoughlin.com/">Kacey Coughlin</a> joint.</p>
          </footer>

    </div> <!-- end .container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

