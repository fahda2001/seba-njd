<?php
require("config.php");
$req_id = $_GET['req_id'];

	$q1 = "update request set status=2 where id=$req_id";

	$run = mysqli_query($db, $q1);
	if($run) {
		echo 'Request Approved';
	} else {
		echo 'Request Not Approved';
	}
	
?>	

