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
<script type = "text/javascript">
      function validate() {
      
         if( document.myForm.Username.value == "" ) {
            alert( "Please provide Username !" );
            document.myForm.Username.focus() ;
            return false;
         }
         if( document.myForm.Password.value == "" ) {
            alert( "Please provide your Password!" );
            document.myForm.Password.focus() ;
            return false;
         }
         var len = document.myForm.Password.value.length;
		  if(len < 8) {
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
	$username = $_POST['Username'];
	$password = $_POST['Password'];

	 $q = "SELECT * FROM Manager WHERE username='$username' ";

	$run = mysqli_query($db, $q);
	$rec = mysqli_fetch_array($run);
	 $no = mysqli_num_rows($run);
	 $rec["password"];
	if($no == 1) {
		if(password_verify($password, $rec["password"]))  {  
			$_SESSION['manager_id'] =  $rec['id'];
			$_SESSION['username'] = $rec['username'];
			$_SESSION['firstname'] = $rec['first_name'];
			$_SESSION['lastname'] = $rec['last_name'];
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=manager home.php">'; 
			exit();
		} else {
			echo '<p id="not">Password is not correct</p>';
		}
	} else {
		echo '<p id="not">Username is not correct</p>';
	}
}	
?>
</td>
</tr>
<tr>
<form   name = "myForm" onsubmit = "return(validate());" method="post">
<td colspan="2" align="center">
	<h2>Manager Sign In</h2>
</td>
</tr>
		<tr>
	<td align="right">
		Username
	</td>
	<td align="center">
		<input type="text" id="Username" name="Username" placeholder="Your Username..">
	</td>
</tr>

<tr>
	<td align="right">
		Password
	</td>
	<td align="center">
		<input type="password" id="Password" name="Password" placeholder="Your  Password..">
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
		<input type = "submit" name="submit" value = "Sign In" id="ManagerButton"  />
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
