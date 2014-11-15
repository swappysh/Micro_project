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

    <title>Assign Grades</title>

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
            <li><a href="courses.php">Assign Courses</a></li>
            <li class = "active"><a href="#">Assign Grades</a></li>
            <li><a href="grad.php">Graduation Results</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="lay">';

$conn;$result;$rollnum;
$check = 0;
if (!isset($_POST['roll_number']) AND !isset($_POST['submit'])) {
	echo '
		<form action = "grades.php" method = "post" role = "form" class = "form-horizontal">
			<div class = "form-group">
				<label for = "roll_number" class="col-sm-2 control-label">Student Roll Number</label>
				<div class = "col-sm-10">
					<input type = "text" name = "roll_number" class = "form-control" placeholder = "Roll Number">
				</div>
			</div>
			<button name = "submit1" value = "submit1" type = "submit" class = "btn btn-default">Submit</button>
		</form>';
}
elseif (!isset($_POST['submit'])) {
	form();
}
else
	insert();

function form()
{
	global $conn,$result,$rollnum;
	connect();
	$rollnum = $_POST['roll_number'];
	$sql = "SELECT c_code FROM studies WHERE rollnum = $rollnum";
	$result = $conn->query($sql);
	$str = '
		<form action = "grades.php" method = "post" role = "form" class = "form-horizontal">
			<div class = "form-group">
				<label class="col-sm-2 control-label">Roll Number</label>
				<div class = "col-sm-1">
					<p class="form-control-static">'.$rollnum.'</p>
				</div>
			</div>';

	if ($result->num_rows<=0) {
		$str .= '</form>';
		echo $str;
	}

	while($row = $result->fetch_assoc()) {
		$course = $row['c_code'];

		$couresult = $conn->query("SELECT c_name FROM Course WHERE c_code = $course");
		$c_name = $couresult->fetch_assoc();
		$c_n = $c_name['c_name'];

		$str .= '
			<div class = "form-group">
				<label for = "'.$course.'" class="col-sm-2 control-label">'.$c_n.'</label>
				<div class = "col-sm-10">
					<input type = "text" name = "'.$course.'" class = "form-control" placeholder = "Grade">
				</div>
			</div>';
		}
	$str .= '
		<input type = "hidden" name = "roll_number" value = "'.$rollnum.'">
		<button name = "submit" value = "submit" type = "submit" class = "btn btn-default">Submit</button>
		</form>
		';
	echo $str;
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
	global $conn,$result,$rollnum;
	$rollnum = $_POST['roll_number'];

	connect();

	$sql = "SELECT c_code FROM studies WHERE rollnum = $rollnum";
	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
		$c_code = $row['c_code'];
		$couresult = $conn->query("SELECT c_name FROM Course WHERE c_code = $c_code");
		$c_name = $couresult->fetch_assoc();
		$c_n = $c_name['c_name'];
		$grade = $_POST[$c_code];

		$sql = "INSERT INTO Grades VALUES('$rollnum','$c_n','$grade')";
		if (mysqli_query($conn, $sql)) {
			echo "
			<div class=\"alert alert-danger\" role=\"alert\">
			New record created successfully</div>";
		} else {
			echo "<div class=\"alert alert-danger\" role=\"alert\">Error: ".mysqli_error($conn)."</div>";
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