<?php session_start(); 
require("config.php");
if(!isset($_SESSION['manager_id'])) {
	echo '<META HTTP-EQUIV="Refresh" Content="10; URL=index.php">'; 
}
$manager_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
$manager_id = $_SESSION['manager_id'];
$username = $_SESSION['username'];
?><html>
<head>
<meta charset="UTF-8">
<title>Welcome Manager</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="jquery.js"></script>
<script>
$(document).ready(function(){
     setInterval(function(){
      $('.viewRequest').load("getAllRequests.php");
     }, 1100);
    
    
});
function showDesc(req_id) {
    
    $.ajax({
        url:"showReqDesc.php",
        method:"GET",
        data:{request_id:req_id},
        success:function(record)
        {
           alert("Description: " + record);
            
        }
    });
}
    
function Approve(req_id) {
    $.ajax({
        url:"Approve.php",
        method:"GET",
        data:{req_id:req_id},
        success:function(record)
        {
             $("#ok").html(record);
            $("#ok").fadeToggle(3000).fadeOut(3000);
        }
    });
}
    
//Decline
function Decline(req_id) {
    $.ajax({
        url:"Decline.php",
        method:"GET",
        data:{req_id:req_id},
        success:function(record)
        {
             $("#ok").html(record);
            $("#ok").fadeToggle(3000).fadeOut(3000);
        }
    });
}   
</script>
</head>
<body>
<table id="content" cellpadding="20">
<tr>
<td align="left">
	<h3>Welcome <?php echo $manager_name ?>!</h3>
</td>
<td align="right">
	<p><a href="logout.php">Sign Out</a><p>
</td>
</tr>
<tr>
<td colspan="2">
    <div  id="ok"></div>
	<h3>Requests</h3>
<div class="viewRequest"></div>

</td>
</tr>

	<tr>
	<td colspan="2" align="center">

</td>
	</tr>
</table>
</body>
</html>
