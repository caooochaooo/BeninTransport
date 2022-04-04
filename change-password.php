<?php
	include 'config.php';
	$msg="";
	if(isset($_GET['reset']))
	{
		if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE otp='{$_GET['reset']}'"))>0)
		{ 
			if(isset($_POST['insubmit']))
			{
				$password=mysqli_real_escape_string($conn,md5($_POST['uppassword']));
				$cpassword=mysqli_real_escape_string($conn,md5($_POST['upcpassword']));
				if($password===$cpassword)
				{
					$query=mysqli_query($conn,"UPDATE users SET password='{$password}',otp='' WHERE otp='{$_GET['reset']}' ");
					if($query)
					{
						header("Location: index.php");
					}
				}else
				{
					$msg="<div>Password and confirm password do not match</div>";
				}	
			}
		}else
		{
			$msg="<div>Reset link do not match</div>";
		}		
	}else
	{
		header("Location: index.php");
	}	
?>
<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<body>
		<div class=container>
			<form action="" method="post">
			<div class="form-content">
				<div class="title">
					Changer mot de passe
				</div>
				<?php echo $msg;?>
				<div class="input-boxes">
					<div class="input-box">
						<input type="password" class="uppassword" name="uppassword"placeholder="Nouveau mot de passe">
					</div>
					<div class="input-box">
						<input type="password" class="upcpassword" name="upcpassword"placeholder="Confirmer mot de passe">
					</div>
					<div class="button input-box">
						<input type="submit" name="insubmit" class="inbtn" value="Changer mot de passe" >
					</div>
					<div class="text">
						Retourner vers!<a href="index.php">Connecter vous</a>
					</div>
				</div>
			</div>	
			</form>
		</div>
	</body>
</html>