<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
	<title>Login</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body">
				<form class="form-horizontal" role="form" method="post" action="#">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="Username" placeholder="Username *" required />
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div> 
						<input type="password" class="form-control" name="pass" id="myInput" placeholder="Password" required>
					</div>
					<div class="row align-items-center remember">
						<label>
					<input type="checkbox" onclick="myFunction()">Show Password
					</label>
					</div>

					<div class="row align-items-center remember">

					
						<input type="checkbox">Remember Me
					</div>
					<div class="form-group">
						<button type="submit" name="login" class="btn float-right login_btn">sign in</button>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="Registrasion.php">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>
<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'user');
	if(!$db)
	{
		echo connect_error();
	}
	if(isset($_POST['login']))
	{
	$Username = $_POST['Username'];
	$pass = $_POST['pass'];
	$password= md5($pass);
	$sql = "SELECT * FROM login where Username='".$Username."' and Password='".$password."'";
	$r = mysqli_query($db,$sql);
	if(mysqli_num_rows($r)>0)
	{
		while($row=mysqli_fetch_assoc($r))
		{
			if($Username==$row['Username'] && $password == $row['Password'])
			{	
				$_SESSION["Username"]=$row['Username'];
				echo "<script type='text/javascript'>alert('Login Successfully');window.location='home.php';</script>";
			}
		}
	}
	else
	{
		echo "<script type='text/javascript'>alert('Username and Password is incorrect');window.location='login.php';</script>";
	}
}
?>