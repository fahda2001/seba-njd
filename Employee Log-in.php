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
<table id="content" cellpadding="10">

<tr>
<td  align="right">
<img src="imgs/icons8-about-100.png" id="logo">
</td>
	<td>
	<h1 align="left">
	صبا نجد</h1>
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
   //-->
</script>
<?php 
include("config.php");
if(isset($_POST['submit'])) {
	$EmployeeID = $_POST['EmployeeID'];
	$password = $_POST['password'];
	 $q = "SELECT * FROM Employee WHERE emp_number='$EmployeeID'";
	$run = mysqli_query($db, $q);
	$no = mysqli_num_rows($run);
	
	if($no ==1) {
		$rec = mysqli_fetch_array($run);
		if(password_verify($password, $rec["password"]))  
		 {  
			$_SESSION['EmployeeID'] =  $rec['id'];
			$_SESSION['emp_number'] =  $rec['emp_number'];
			$_SESSION['firstname'] = $rec['first_name'];
			$_SESSION['lastname'] = $rec['last_name'];
			$_SESSION['job'] = $rec['job_title'];

			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=Employee home.php">'; 
			exit();
		} else {
			echo '<p id="not">password is not correct</p>';
		}
	} else {
		echo '<p id="not">username is not correct</p>';
	}
}	
?>	
</td>
</tr>
<form method="post"  name = "myForm" onsubmit = "return(validate());">
<tr>
<td colspan="2" align="center">
	<h2>Employee Sign In</h2>
</td>
</tr>
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
		Password
	</td>
	<td align="center">
		<input type="password" id="Password" name="password" placeholder="Your  Password..">
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
		<input type = "submit" name="submit" value = "Sign In" id="EmpButton"  />
</td>
	</tr>
</form>
	<tr>
	
	<td colspan="2" align="center">

</td>
	</tr>

</table>
     <footer>
      <section class="footer" bgcolor="#DAC3AA" style="border-radius: 10px 10px">
	
		<p style="color: #8b5a2b">@ Copyrights 2022. All are resvered</p>
	</section>
    </footer>
</body>
</html>
