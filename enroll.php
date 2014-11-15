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

    <title>Enroll Student</title>

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
            <li class="active"><a href="#">Enroll Student</a></li>
            <li><a href="courses.php">Assign Courses</a></li>
            <li><a href="grades.php">Assign Grades</a></li>
            <li><a href="grad.php">Graduation Results</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="lay">';

$conn;
if (isset($_POST['fname'])) {
	insert();
}
else form();

function form()
{
	echo '
		<form action = "enroll.php" method = "post" role = "form" class = "form-horizontal">
			<div class = "form-group">
				<label for = "fname" class = "col-sm-2 control-label">Student\'s First Name</label>
				<div class="col-sm-10">
					<input type = "text" name = "fname" class = "form-control" placeholder = "First Name">
				</div>
			</div>
			<div class = "form-group">
				<label for = "lname" class = "col-sm-2 control-label">Student\'s Last Name</label>
				<div class="col-sm-10">
					<input type = "text" name = "lname" class = "form-control" placeholder = "Last Name">
				</div>
			</div>
			<div class = "form-group">
				<label for = "faname" class = "col-sm-2 control-label">Father\'s name</label>
				<div class="col-sm-10">
					<input type = "text" name = "faname" class = "form-control" placeholder = "Father\'s Name">
				</div>
			</div>
			<div class = "form-group">
				<label for = "mname" class = "col-sm-2 control-label">Mother\'s name</label>
				<div class="col-sm-10">
					<input type = "text" name = "mname" class = "form-control" placeholder = "Mother\'s Name">
				</div>
			</div>
			<div class = "form-group">
				<label for = "address" class = "col-sm-2 control-label">Address</label>
				<div class="col-sm-10">
					<textarea rows = "5" name = "address" class = "form-control" placeholder = "Address"></textarea>
				</div>
			</div>
				<button type = "submit" class = "btn btn-default" name = "submit" value = "submit">Submit</button>
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
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$faname = $_POST['faname'];
	$year = date("Y",time());
	$mname = $_POST['lname'];
	$add = $_POST['address'];
	$sql = "INSERT INTO Student(fname,lname,father_name,mother_name,address,year_of_enrollment,current_year) VALUES('$fname','$lname','$faname','$mname','$add','$year',1)";
	if (mysqli_query($conn, $sql)) {
	echo "
		<div class=\"alert alert-success\" role=\"alert\">New record created successfully</div>";
	} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Error: ".mysqli_error($conn)."</div>";
	}
	$sql = "SELECT * FROM Student";
	$result = $conn->query($sql);
	$rollno = $result->num_rows + 999;
	
	$sql = "ALTER TABLE Student AUTO_INCREMENT = 1000";
	mysqli_query($conn, $sql);

	$sql = "SELECT * FROM Student WHERE roll_number = $rollno";
	$result = $conn->query($sql);

	echo "<table class=\"table table-hover\">
		<tr>
			<th>Roll Number</th>
			<th>Name</th>
			<th>Father's Name</th>
			<th>Mother's Name</th>
			<th>Address</th>
		</tr>";
	while ($row = $result->fetch_assoc()) {
		echo "
			<tr>
				<td>".$row['roll_number']."</td>
				<td>".$row['fname']." ".$row['lname']."</td>
				<td>".$row['father_name']."</td>
				<td>".$row['mother_name']."</td>
				<td>".$row['address']."</td>
			</tr>";
	}
	echo "</table>";
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