<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'user');
if(!$db)
{
    echo connect_error();
}
$Username=$_SESSION["Username"];
$q="SELECT * FROM login where Username='".$Username."'";
$r=mysqli_query($db,$q);
while($row=mysqli_fetch_assoc($r))
{
?>
<html>
<head>
<title>User Data</title>
</head>
<body>
<center>
<table border='1'>
<tr>
<td><b>Username</b></td>
<td><?php echo $row['Username']?></td>
</tr>
<tr>
<td><b>Name</b></td>
<td><?php echo $row['Name']?></td>
</tr>
<tr>
<td><b>Phone Number</b></td>
<td><?php echo $row['Phone']?></td>
</tr>
<tr>
<td><b>Gender</b></td>
<td><?php echo $row['Gender']?></td>
</tr>
<tr>
<td><b>Email id</b></td>
<td><?php echo $row['Email']?></td>
</tr>
<tr>
<td colspan="2"><a href="logout.php"><b><center>Logout</center></b></a></td>
</tr>
</table>
</center>
</body>
</html>
<?php
}
?>