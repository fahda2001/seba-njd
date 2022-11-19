<?php session_start(); ?><html>
<head>
<meta charset="UTF-8">
<title>صبا نجد</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
<img src="imgs/icons8-about-100.png" >


<div id="header" style="border-radius: 20px;"> 
	
	<nav class="topnav">
	
            <a href="index.php">Home Page</a></li>
        <a href="Employee Log-in.php">Employee Log-in</a></li>
        <a href="Employee sign up page.php">Employee Sign-Up</a></li>
        <a href="Manager Log-in.php">Manager Log-in</a></li>
	
</div>

</header>
    <main>
<table id="content" cellpadding="10">
<tr>
<td  align="right" width="45%">
<img src="imgs/icons8-about-100.png" id="logo">
</td>
	<td>
	<h1 align="left">
	صبا نجد</h1>
</td>
</tr>
<tr>
<td colspan="2" align="center">
	<h2>Employee Sign up</h2>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<script type = "text/javascript">
  function validate() {

	 if( document.myForm.EmployeeID.value == "" ) {
		alert( "Please provide Employee ID!" );
		document.myForm.EmployeeID.focus() ;
		return false;
	 }
	 if( document.myForm.firstname.value == "" ) {
		alert( "Please provide your frist name!" );
		document.myForm.firstname.focus() ;
		return false;
	 }
	 if( document.myForm.lastname.value == "" ) {
		alert( "Please provide your last name!" );
		document.myForm.lastname.focus() ;
		return false;
	 }
	  if( document.myForm.job.value == "" ) {
		alert( "Please provide your job title!" );
		document.myForm.job.focus() ;
		return false;
	 }
	 if( document.myForm.Password.value == "" ) {
		alert( "Please provide your Password!" );
		document.myForm.Password.focus() ;
		return false;
	 }
		var len = document.myForm.Password.value.length;
	  if(len <8) {
		  alert( "Password must be at least 8 letters!" );
		  document.myForm.Password.focus() ;
		  return false;
	  }

	 return( true );
  }
</script>
<?php 
include("config.php");
if(isset($_POST['submit'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$job = $_POST['job'];
	$EmployeeID = $_POST['EmployeeID'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$q1 = "SELECT * FROM employee WHERE emp_number='$EmployeeID'";
	$run = mysqli_query($db, $q1);
	$no1 = mysqli_num_rows($run);
	if($no1 ==1) {
		echo '<p  id="not">This employee is found into system</p>';
			echo '<META HTTP-EQUIV="Refresh" Content="4; URL=Employee sign up page.php">'; 
	} else {
		$q2 = "INSERT INTO Employee VALUES(NULL,'$EmployeeID','$firstname', '$lastname', '$job', '$password')";

		$run2 = mysqli_query($db, $q2);
		if($run2) {
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['EmployeeID'] = $EmployeeID;
			$_SESSION['job'] = $job;

			echo '<p id="ok">Creating Account Successfully</p>';
			echo '<META HTTP-EQUIV="Refresh" Content="2; URL=Employee home.php">'; 
		}
	}


}	
?>
</td>
</tr>

<form method="post"  name = "myForm" onsubmit = "return(validate());">
<tr>
	<td align="right">
		Employee ID
	</td>
	<td align="center">
		<input type="text" id="EmployeeID" name="EmployeeID" placeholder="Your Employee ID..">
	</td>
</tr>
<tr>
	<td align="right">
		First Name
	</td>
	<td align="center">
		<input type="text" id="fname" name="firstname" placeholder="Your first name..">
	</td>
</tr>
<tr>
	<td align="right">
		Last Name
	</td>
	<td align="center">
		<input type="text" id="lastname" name="lastname" placeholder="Your last name..">
	</td>
</tr>
<tr>
	<td align="right">
		Job Title
	</td>
	<td align="center">
		<input type="text" id="job" name="job" placeholder="Your job Title..">
	</td>
</tr>
<tr>
	<td align="right">
		Password
	</td>
	<td align="center">
		<input type="password" id="Password" name="password" placeholder="Your  Password..">
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
		<input type = "submit" name="submit" value = "Sign Up" id="EmpButton"  />
</td>
	</tr>
</form>
	<tr>
	<td colspan="2" align="center">

</td>
	</tr>

</table>
    </main>
      <footer>
      <section class="footer" bgcolor="#DAC3AA" style="border-radius: 10px 10px">
	
		<p style="color: #8b5a2b">@ Copyrights 2022. All are resvered</p>
	</section>
    </footer>
</body>
</html>
