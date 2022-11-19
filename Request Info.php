<?php session_start(); 
require("config.php");
$loggedIn = "employee";

if(isset($_SESSION['employeeID'])) {
	$emp_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
	$employee_ID = $_SESSION['employeeID'];
	$job_title = $_SESSION['job'];
	$loggedIn = "employee";
} elseif(isset($_SESSION['manager_id'])) {
	$manager_ID = $_SESSION['manager_id'];
	$loggedIn = "manager";
} else {
	if(!isset($_SESSION['employeeID'])) {
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
	}
}



?><html>
<head>
<meta charset="UTF-8">
<title>صبا نجد</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table id="content" cellpadding="20">
<tr>
<td align="left">
<?php
$request_id = $_GET['request_id'];
$req_status = 1;
$q1 = "";
if($loggedIn == "employee") {
	$q1 = "SELECT * FROM Request where emp_id='$employee_ID' and id=$request_id";
} else {
	$q1 = "SELECT * FROM Request where id=$request_id";
}

	$run1 = mysqli_query($db, $q1);
	$no1 = mysqli_num_rows($run1);
	if($no1==0) {
		echo "No Found Request";
	} else {
		$i = 1;
		$rec1 = mysqli_fetch_array($run1);
		$req_status = $rec1['status'];
		$employee_ID = $rec1['emp_id'];
		 $q3 = "SELECT * FROM employee where id=$employee_ID";
		$run3 = mysqli_query($db, $q3);
		$rec3 = mysqli_fetch_array($run3);
		$emp_name = $rec3['first_name'] . " " . $rec3['last_name'];
	?>
	
	<h3><?php 
			$service_id = $rec1['service_id'];
			$q2 = "SELECT * FROM service where id=$service_id";
			$run2 = mysqli_query($db, $q2);
			$rec2 = mysqli_fetch_array($run2);
			echo  ucwords($rec2['type']);
		if( $rec1['status'] == 1) {
			echo ' <label> In progress</label>';
		} else if( $rec1['status'] == 2) {
			echo ' <label id="Approved"> Approved</label>';
		} elseif( $rec1['status'] == 3) {
			echo ' <label id="Declined"> Declined</label>';
		}
		$status = $rec1['status'];
	}
		?></h3>
	<p><strong><?php echo $emp_name ?></strong></p>
	<p>
	<?php
		if($loggedIn == "manager") {
			if($status == 1) {
				echo '<a href="Approve.php?request_id=' . $request_id . '">Approve</a> ';
				echo ' <a href="Decline.php?request_id=' . $request_id . '">Decline</a>';
			} else if($status == 2) {
				echo '<a href="Decline.php?request_id=' . $request_id . '">Decline</a>';
			} if($status == 3) {
				echo '<a href="Approve.php?request_id=' . $request_id . '">Approve</a>';
			}
		} else if($loggedIn == "employee") {
			echo '<a href="Edit request.php?request_id=' . $request_id . '">Edit</a>';
		}
	?>
	<p>
</td>
<td align="right">
	<p><a href="logout.php">Sign Out</a><p>
</td>
</tr>
<tr>
<td colspan="2">
	<h3>Description</h3>
	<p><?php echo $rec1['description'] ?></p>
	<p><?php 
	
		$exts = array('gif', 'png', 'jpg', 'jpeg'); 
		$type1 = in_array(@end(explode('.', $rec1['attachment1'])), $exts);
		$type2 = in_array(@end(explode('.', $rec1['attachment2'])), $exts);
		 ?></p>
	<h3>Images Attachments</h3>
<table id="requests">
	<tr>
		<th bgcolor="#16a085">Attachment Picture</th>
	</tr>

	<tr>
		<td>
			<?php
				if($type1) {
					echo "<img src='" . $rec1['attachment1'] . "' width='200' height='200'>";
				} 
				if($type2) {
					echo "<img src='" . $rec1['attachment2'] . "' width='200' height='200'>";
				}
			?>
			
		</td>
		
	</tr>
	
</table>
	<p></p>
	<table id="requests">

	<tr>
		<th bgcolor="#16a085">Attachment name</th>
		<th bgcolor="#16a085">Download</th>
	</tr>

	<tr>
		
		<td>
			<?php
				if(!$type2) {
					echo  'attachment1';
				} else if(!$type2) {
					echo  'attachment2';
				}
			?>
		</td>
		<td>
			<?php
				if(!$type2) {
					echo "<a href='" . $rec1['attachment1'] ."'>Download</a>";
				} else if(!$type2) {
					echo "<a href='" . $rec1['attachment2'] ."'>Download</a>";
				}
			?>
			
		</td>
	</tr>
	
</table>
</td>
</tr>

	<tr>
	<td colspan="2" align="center">

</td>
	</tr>
</table>
</body>
</html>
