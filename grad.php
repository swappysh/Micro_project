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

    <title>Graduation Results</title>

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
            <li><a href="grades.php">Assign Grades</a></li>
            <li class = "active"><a href="#">Graduation Results</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="lay">';

$conn;
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

if (!isset($_POST['rollnum'])) {
	echo '
	<form action = "grad.php" method = "post" role = "form" class = "form-horizontal">
		<div class = "form-group">
			<label for = "rollnum" class="col-sm-2 control-label">Roll Number</label>
			<div class = "col-sm-10">
				<input type = "text" name = "rollnum" class = "form-control" placeholder = "Roll Number">
			</div>
		</div>
		<button name = "submit" value = "submit" type = "submit" class = "btn btn-default">Submit</button>
	</form>';
}
else {
	global $conn;
	$roll = $_POST['rollnum'];

	connect();

	$sql = "SELECT rollnum,course,grade, Min_grade FROM Grades,Course WHERE course = c_name AND rollnum = $roll";
	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
		if(strcmp($row['grade'], $row['Min_grade'])<=0) {
			echo "<div class=\"alert alert-success\" role=\"alert\">".$row['course']."  PASS</div>";
		}
		else
			echo "<div class=\"alert alert-danger\" role=\"alert\">".$row['course']."   FAIL</div>";
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