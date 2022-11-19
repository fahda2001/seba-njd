<?php session_start(); 
require("config.php");
$loggedIn = "employee";
if(!isset($_SESSION['employeeID'])) {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
}
if(isset($_SESSION['employeeID'])) {
	$emp_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
$employee_ID = $_SESSION['employeeID'];
$job_title = $_SESSION['job'];
	$loggedIn = "employee";
} 

$request_id = $_GET['request_id'];



?><html>
<head>
<meta charset="UTF-8">
<title>Edit request</title>
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
			$q1 = "update request set service_id=$service_type, description='$description', attachment1='$target1', attachment2='$target2' where id=$request_id";
		} else if($flag1 && !$flag2) {
			$q1 = "update request set service_id=$service_type, description='$description', attachment1='$target1', attachment2=NULL where id=$request_id";
		} else if(!$flag1 && $flag2) {
			$q1 = "INSERT INTO request VALUES(NULL,$employee_ID,  $service_type, '$description', NULL,'$target2', 1)";
			$q1 = "update request set service_id=$service_type, description='$description', attachment1=NULL, attachment2='$target2' where id=$request_id";
		} else if(!$flag1 && !$flag2) {
			$q1 = "update request set service_id=$service_type, description='$description', attachment1=NULL, attachment2=NULL where id=$request_id";
		}
		
		$run = mysqli_query($db, $q1);
		if($run) {
			echo '<p id="ok">Request Updated</p>';
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
<form method="post" name="myForm" onsubmit = "return(validate());"  enctype="multipart/form-data">
<?php
$q0 = "SELECT * FROM Request where id=$request_id";
$run0 = mysqli_query($db, $q0);
$rec0 = mysqli_fetch_array($run0);
?>
<tr>
<td colspan="2" align="center">
	<h2>Edit Request</h2>
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
					if($rec['id'] == $rec0['service_id']) {
						echo "<option value='" .  $rec['id']  . "' selected>" . $rec['type'] . "</option>";
					} else {
						echo "<option value='" .  $rec['id']  . "'>" . $rec['type'] . "</option>";
					}
					
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
		<textarea rows="6" id="description" name="description" placeholder="request  Description.."><?php echo $rec0['description'] ?></textarea>
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
		<input type="submit" value="Edit Request" id="button" name="submit">
</td>
	</tr>
	<tr>
	<td colspan="2" align="center">

</td>
	</tr>
</form>
</table>

</body>
<footer>
      <section class="footer" bgcolor="#DAC3AA" style="border-radius: 10px 10px">
	
		<p style="color: #8b5a2b">@ Copyrights 2022. All are resvered</p>
	</section>
    </footer>
</html>
