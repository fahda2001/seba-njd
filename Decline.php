<?php
require("config.php");
$req_id = $_GET['req_id'];

	$q1 = "update request set status=3 where id=$req_id";

	$run = mysqli_query($db, $q1);
	if($run) {
		echo 'Request Declined';
	} else {
		echo 'Request Not Declined';
	}
	
?>	

