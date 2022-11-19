<?php
include "config.php";
$q = "SELECT * FROM service";
$run = mysqli_query($db, $q);
while($rec = mysqli_fetch_array($run)) {
?>
<table style="width: 100%; border: 1px solid #CD853F; background: #ffffff" border="1">
	<tr>
		<th colspan="3" bgcolor="#dfb886"><span style="color:black"><?php echo $rec['type'] ?></span></th>
	</tr>
	<?php
	$service_id = $rec['id'];
	 $q1 = "SELECT * FROM request where service_id=$service_id ORDER BY status ASC";
	$run1 = mysqli_query($db, $q1);
	$no1 = mysqli_num_rows($run1);
	if($no1<>0) {
	?>
	<tr bgcolor="#dfb886">
		<th width="50%"><span style="color:black">Request</span></th>
		<th><span style="color:black">Status</span></th>
		<th><span style="color:black">Options</span></th>
	</tr>
	<?php
		while($rec1 = mysqli_fetch_array($run1)) {
            $req_id = $rec1['id'];
	?>
		<tr 
			<?php if( $rec1['status'] == 1) { 
				echo " style='background-color:#FFE4E1' ";
			}?>
		>
			<td>

			<a onmouseover="showDesc(<?php echo $req_id; ?>)" href="Request Info.php?request_id=<?php echo $rec1['id'] ?>">
				<strong><?php 
					echo $rec1['id'] . " - ";
					$emp_id = $rec1['emp_id'];
					$q2 = "SELECT * FROM employee where id='$emp_id'";
					$run2 = mysqli_query($db, $q2);
					$row2 = mysqli_fetch_array($run2);
					echo $row2['first_name'] . " " . $row2['last_name'];
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
			<td id="btns">
				<?php
				$request_id = $rec1['id'];
				if($rec1['status'] == 1) {
					echo '<a onclick="Approve(' . $request_id . ')">Approve</a> ';
					echo ' <a onclick="Decline(' . $request_id . ')">Decline</a>';
				} else if($rec1['status'] == 2) {
					echo ' <a onclick="Decline(' . $request_id . ')">Decline</a>';
				} if($rec1['status'] == 3) {
					echo '<a onclick="Approve(' . $request_id . ')">Approve</a> ';
				}
				?>
			</td>
		</tr>
	<?php
		}
	}
	?>
</table><br>
<?php
}
?>