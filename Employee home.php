<?php session_start(); 
require("config.php");
if(!isset($_SESSION['EmployeeID'])) {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
}
$emp_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
$employeeID = $_SESSION['EmployeeID'];
$job_title = $_SESSION['job'];
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
	<h3>Welcome <?php echo $emp_name ?>!</h3>
	<p><strong>Employee’s ID: </strong><?php echo $employeeID ?></p>
	<p><strong>Job Title: </strong> <?php echo $job_title ?><p>
</td>
<td align="right">
	<p><a href="logout.php">Sign Out</a><p>
	<p><a href="add request.php">+ Add Request</a><p>
</td>
</tr>
<tr>
<td colspan="2">
	<h3>Requests</h3>
<table style="width: 100%; border: 1px solid #C69A6F; background: #ffffff" border="1">
	<tr>
		<th colspan="3" bgcolor="#C69A6F"><p style="color:white">In Progress</p></th>
	</tr>
	<?php
		 $q = "SELECT * FROM request where emp_id='$employeeID' and status=1";
		$run = mysqli_query($db, $q);
		$no = mysqli_num_rows($run);
		if($no==0) {
			echo "No Requests";
		} else {
			while($rec = mysqli_fetch_array($run, MYSQLI_BOTH)) {
		?>
		<tr>
			<td>

			<a href="Request Info.php?request_id=<?php echo $rec['id'] ?>">
				<strong><?php 
					echo $rec['id'] . " - ";
					$service_id = $rec['service_id'];
					$q2 = "SELECT * FROM service where id=$service_id";
					$run2 = mysqli_query($db, $q2);
					$rec2 = mysqli_fetch_array($run2);
					echo $rec2['type'];
				?></strong>
			</a>
			</td>
			<td>
				<?php
				if( $rec['status'] == 1) {
					echo 'In progress';
				} else if( $rec['status'] == 2) {
					echo 'Approved';
				} elseif( $rec['status'] == 3) {
					echo 'Declined';
				}
				?>
			</td>
			<td><a href="Edit Request.php?request_id=<?php echo $rec['id'] ?>">Edit</a></td>
		</tr>
	<?php
		}
	}
	?>
</table>
<p></p>
<table style="width: 100%; border: 1px solid #CD853F; background: #ffffff" border="1">
	<tr>
		<th colspan="3" bgcolor="#A0522D"><p style="color:white">Previous Requests</p></th>
	</tr>

	<tr bgcolor="#CD853F">
		<th><p style="color:black">Request</p></th>
		<th><p style="color:black">Status</p></th>
		<th><p style="color:black">Edit</p></th>
	</tr>
	<?php
		$q1 = "SELECT * FROM Request where emp_id='$employeeID' and status<>1";
		$run1 = mysqli_query($db, $q1);
		$no1 = mysqli_num_rows($run1);
		if($no1==0) {
			echo "<p id='not'>No Previous Requests Data Found</p>";
		} else {
			while($rec1 = mysqli_fetch_array($run1)) {
		?>
			<tr>
				<td>

				<a href="Request Info.php?request_id=<?php echo $rec1['id'] ?>">
					<strong><?php 
						echo $rec1['id'] . " - ";
						$service_id = $rec1['service_id'];
						$q4 = "SELECT * FROM service where id=$service_id";
						$run4 = mysqli_query($db, $q4);
						$rec4 = mysqli_fetch_array($run4);
						echo $rec4['type'];
					?></strong>
				</a>
				</td>
				<td>
					<?php
					if( $rec1['status'] == 1) {
						echo 'In progress';
					} else if( $rec1['status'] == 2) {
						echo 'Approved';
					} elseif( $rec1['status'] == 3) {
						echo 'Declined';
					}
					?>
				</td>
				<td><a href="Edit request.php?request_id=<?php echo $rec1['id'] ?>">Edit</a></td>
			</tr>
		<?php
			}
		}
	?>
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
