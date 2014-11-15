<?php

echo '<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="templates/FranklinExcellenceCoin.png">

    <title>Assign Courses</title>

    <!-- Bootstrap core CSS -->
    <link href="templates/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="templates/lay.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Home</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="enroll.php">Enroll Student</a></li>
            <li class = "active"><a href="#">Assign Courses</a></li>
            <li><a href="grades.php">Assign Grades</a></li>
            <li><a href="grad.php">Graduation Results</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="lay">';

$conn;
if (isset($_POST['roll_number'])) {
	insert();
}
else form();

function form()
{
	echo '
		<form action = "courses.php" method = "post" role = "form" class = "form-horizontal">
			<div class = "form-group">
				<label for = "roll_number" class="col-sm-2 control-label">Student Roll Number</label>
				<div class="col-sm-10">
					<input type = "text" name = "roll_number" class = "form-control" placeholder = "Roll Number">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox" name = "course[]" value = "1187"> 1187
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name = "course[]" value = "1217"> 1217
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name = "course[]" value = "1239"> 1239
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name = "course[]" value = "1872"> 1872
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name = "course[]" value = "4568"> 4568
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name = "course[]" value = "9172"> 9172
						</label>
					</div>
				</div>
			</div>
			<button name = "submit" value = "submit" type = "submit" class = "btn btn-default">Submit</button>
		</form>
		';
}

function connect()
{
	global $conn;
	$servername = "localhost";
	$username = "root";
	$password = "getready4";
	$dbname = "micro";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("<div class=\"alert alert-danger\" role=\"alert\">Connection failed: ".mysqli_connect_error()."</div>");
	}
}

function insert()
{
	global $conn;

	connect();
	$roll = $_POST['roll_number'];
	$course = $_POST['course'];
	$N = count($course);

	for ($i=0; $i < $N ; $i++) { 
		$sql = "INSERT INTO studies VALUES($roll,$course[$i])";

		if (mysqli_query($conn, $sql)) {
			echo "<div class=\"alert alert-success\" role=\"alert\">New record created successfully</div>";
			} else {
				echo "<div class=\"alert alert-danger\" role=\"alert\">Error: <br>".mysqli_error($conn)."</div>";
			}
	}

}

echo '</div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="templates/jquery.js"></script>
    <script src="templates/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="templates/ie10-viewport-bug-workaround.js"></script>
  

</body></html>';
?>