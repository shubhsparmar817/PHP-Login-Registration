<?php
	session_start();
	$_SESSION['Username']=null;
    session_destroy();
    echo "<script type='text/javascript'>alert('Logout Successfully');window.location='login.php';</script>";
?>