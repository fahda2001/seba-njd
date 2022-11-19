<?php session_start(); 
require("config.php");
if(!isset($_SESSION['EmployeeID'])) {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
}
$emp_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
$employee_ID = $_SESSION['EmployeeID'];
$job_title = $_SESSION['job'];
?><html>
<head>
<meta charset="UTF-8">
<title>add request</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	

<table id="content" cellpadding="10">
<tr>
<td colspan="2" align="center">
	<script type = "text/javascript">
      function validate() {
      	if( document.myForm.service_type.value == "-1" ) {
            alert( "Please provide your service type!" );
            return false;
         }
         if( document.myForm.description.value == "" ) {
            alert( "Please provide description !" );
            document.myForm.description.focus() ;
            return false;
         }
         if( document.myForm.attach1.value == "" ) {
            alert( "Please provide your attachment 1!" );
            document.myForm.attach1.focus() ;
            return false;
         }
         
         return( true );
      }
   //-->
</script>
<?php 
	if(isset($_POST['submit'])) {
		$flag1 = 0;
		$flag2 = 0;

		$service_type = $_POST['service_type'];
		$description = $_POST['description'];


		 $main = "attachs/";

		if ($_FILES['attach1']['size'] == 0) {
			$flag1 = NULL;
		} else {
		  $file1 = $_FILES['attach1']['name'];
		  $target1 = $main . "-" .  $file1;
		  $flag1 = move_uploaded_file($_FILES["attach1"]["tmp_name"], $target1);
	   }

	   if ($_FILES['attach2']['size'] == 0) {
			$flag2 = NULL;
		} else {
		  $file2 = $_FILES['attach2']['name'];
		  $target2 = $main . "-" .  $file2;
		  $flag2 =move_uploaded_file($_FILES["attach2"]["tmp_name"], $target2);
	   }

		$q1 = "";
		
		if($flag1 && $flag2) {
			$q1 = "INSERT INTO request VALUES(NULL, $employee_ID, $service_type, '$description', '$target1',  '$target2', 1)";
		} else if($flag1 && !$flag2) {
			$q1 = "INSERT INTO request VALUES(NULL, $employee_ID, $service_type,  '$description', '$target1', NULL, 1)";
		} else if(!$flag1 && $flag2) {
			$q1 = "INSERT INTO request VALUES(NULL,$employee_ID,  $service_type, '$description', NULL,'$target2', 1)";
		} else if(!$flag1 && !$flag2) {
			$q1 = "INSERT INTO request VALUES(NULL, $employee_ID, $service_type, '$description', NULL,NULL, 1)";
		}
		
		$run = mysqli_query($db, $q1);
		if($run) {
			echo '<p id="ok">Request Saved</p>';
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=Employee home.php">'; 
			exit();
		} else {
			echo '<p id="not">Request Not Saved</p>';
			exit();
		}
	}	
?>	
</td>
</tr>
<form method="post"  name="myForm" onsubmit = "return(validate());" enctype="multipart/form-data">

<tr>

<td colspan="2" align="center">
	<h2>Add Request</h2>
</td>
</tr>
		<tr>
	<td align="right">
		Service Type
	</td>
	<td align="center">
		<select name="service_type" id="service_type">
			<option value="-1"></option>
			<?php
				$q = "SELECT * FROM service";
				$run = mysqli_query($db, $q);
				while($rec = mysqli_fetch_array($run)) {
					echo "<option value='" .  $rec['id']  . "'>" . $rec['type'] . "</option>";
				}
			?>
		</select>
	</td>
</tr>
<tr>
	<td align="right">
		Description
	</td>
	<td align="center">
		<textarea rows="6" id="description" name="description" placeholder="request  Description.."></textarea>
	</td>
</tr>
<tr>
	<td align="right">
		Attachment 1
	</td>
	<td align="center">
		<input type="file" id="attach1" name="attach1">
	</td>
</tr>
<tr>
	<td align="right">
		Attachment 2
	</td>
	<td align="center">
		<input type="file" id="attach2" name="attach2">
	</td>
</tr>

<tr>
	<td colspan="2" align="right">
		<input type="submit" value="Add Request" id="button" name="submit">
</td>
	</tr>

	<tr>
	<td colspan="2" align="center">

</td>
	</tr>
</form>
</table>

</body>
</html>
