<html>
<head>
<title>Registrasion</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/reg.css">
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <h2>Login into port from here</h3>
                        <a href="login.php"><input type="submit" name="" value="Login"/></a><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Registrasion User</h3>
                                <form method="post" action="#">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="Username" id="Username" onchange="vari(this.value)" placeholder="Username *" required/>
                                            <div class="result" style="color:red" id="result"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Full Name *" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control" placeholder="Your Phone *" required pattern="[0-9]{10}" title="Please enter valid 10 digit phone number" value="" />
                                        </div>
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" value="male" checked>
                                                    <span> Male </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" value="female">
                                                    <span>Female </span> 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="Mail" placeholder="Your Email *" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please enter valid email"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password1" placeholder="Password *" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password2" placeholder="Confirm Password *" value="" required />
                                        </div>
                                        <input type="submit" class="btnRegister" id="btnSubmit" name="register"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
<script type="text/javascript">
$(document).ready(function(){
$('#Username').keyup(function(){
// alert('sds');
var username = $(this).val(); // Get username textbox using $(this)

var Result = $('#result'); // Get ID of the result DIV where we display the results

if(username.length > 2) { // if greater than 2 (minimum 3)
Result.html('Loading...'); // you can use loading animation here
var dataPass = 'action=availability&username='+username;
$.ajax({ // Send the username val to available.php
type : 'POST',
data : dataPass,
url  : 'varidatauser.php',
success: function(responseText){ // Get the result
//alert(responseText);
if(responseText == 0){
Result.html('<span class="success"></span>');
$('#btnSubmit').prop('disabled', false);
}
else if(responseText > 0){
Result.html('<span class="error">Username is Taken please change</span>');
$("#btnSubmit").prop("disabled", true);
}
else{
alert('Problem with sql query');
$("#btnSubmit").prop("disabled", true);
}
}
});
}
if(username.length == 0) {
Result.html('');
$("#btnSubmit").prop("disabled", true);
}
});
});
</script>
</body>
</html>
<?php
    $Username="";
	$Name = "";
	$Gender = "";
	$Mobile = "";
	$Mail = "";
	$Password1 = "";
    $Password2 = "";
    $errors=array();
	
	$db = mysqli_connect('localhost', 'root', '', 'user');
	
	//registration button click
	if(isset($_POST['register']))
	{
        $Username= mysqli_real_escape_string($db, $_POST['Username']);
		$Name = mysqli_real_escape_string($db, $_POST['name']);
		$Gender = mysqli_real_escape_string($db, $_POST['gender']);
		$Mobile = mysqli_real_escape_string($db, $_POST['phone']);
		$Mail = mysqli_real_escape_string($db, $_POST['Mail']);
		$Password1 = mysqli_real_escape_string($db, $_POST['password1']);
		$Password2 = mysqli_real_escape_string($db, $_POST['password2']);
		
		//Fields are filled properly
		if($Password1 != $Password2)
		{
			echo "<script type='text/javascript'>alert('Password Does not Match');window.location='Registrasion.php';</script>";	
		}
		else
		{
		//if there are no error,save user to database
			if(count($errors)== 0)
			{
                echo $Name;
			    $Password = md5($Password1);//encrypt password before storing database for security
				$sql = "INSERT INTO login (Username, Name, Phone, Gender,Email, Password) 
				VALUES ('$Username', '$Name', '$Mobile', '$Gender', '$Mail', '$Password')";
				
				mysqli_query($db, $sql);
                echo "<script type='text/javascript'>alert('Registrasion Successfully..!! Please Login');window.location='login.php';</script>";
			}
		}
	}
?>