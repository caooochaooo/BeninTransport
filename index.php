<?php
	session_start();
	if(isset($_SESSION['SESSION_EMAIL'])){
		header('Location: BeninTaxi/home.php');
		die();
	}
	include 'config.php';	
	$msg="";
	//sign in
	$msgin="";
	if(isset($_POST['insubmit']))
	{
		$inemail=mysqli_real_escape_string($conn,$_POST['inemail']);
		$inpassword=mysqli_real_escape_string($conn,md5($_POST['inpassword']));
		$sql="SELECT * FROM users WHERE email='{$inemail}' AND password='{$inpassword}'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)===1)
		{
			$row=mysqli_fetch_assoc($result);
			if(empty($row['otp']))
			{
				$_SESSION['SESSION_EMAIL']=$inemail;
				header('Location: BeninTaxi/home.php');
				$msgin="<div>First verify your account and try again.</div>";
			}
			else{
				$msgin="<div>First verify your account and try again.</div>";
			}
		}else{
			$msgin="<div>Email or password do not match</div>";
		}
		
	}
	//register and activate account
	if(isset($_GET['verification']))
	{
		if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE otp='{$_GET['verification']}'"))>0)
		{
			$query=mysqli_query($conn,"UPDATE users SET otp='' WHERE otp='{$_GET['verification']}'");
			if($query)
			{
				$msg="<div>Account verification has been successfully complete</div>";
			}
		}
	}
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	//Load Composer's autoloader
	require 'vendor/autoload.php';
	if(isset($_POST['upsubmit'])){
		$upname=mysqli_real_escape_string($conn,$_POST['upname']);
		$upfirstname=mysqli_real_escape_string($conn,$_POST['upfirstname']);
		$emails=filter_var(mysqli_real_escape_string($conn,$_POST['upemail']), FILTER_SANITIZE_EMAIL);
		$upemail="";
		$upmobile="";
		if(filter_var($emails, FILTER_VALIDATE_EMAIL))
		{
			$upemail=$emails;
		}else{
			$msg="<div>Failed to subscribe ,Put the right mail</div>";
		}
		if(strlen(mysqli_real_escape_string($conn,$_POST['upmobile']))>15)
		{
			$msg="<div>Failed to subscribe ,Put the right mobile number</div>";
		}elseif(strlen(mysqli_real_escape_string($conn,$_POST['upmobile']))<7)
		{
			$msg="<div>Failed to subscribe ,Put the right mobile number</div>";
		}
		elseif(strlen(mysqli_real_escape_string($conn,$_POST['upmobile']))>=8 && strlen(mysqli_real_escape_string($conn,$_POST['upmobile']))<=15)
		{
			$upmobile=mysqli_real_escape_string($conn,$_POST['upmobile']);
		}
		$uppassword=mysqli_real_escape_string($conn,$_POST['uppassword']);
		$upcpassword=mysqli_real_escape_string($conn,$_POST['upcpassword']);
		$upaccount=mysqli_real_escape_string($conn,$_POST['account']);
		if(isset($_POST['sex']))
		{
			$upsex=mysqli_real_escape_string($conn,$_POST['sex']);
		}	
		$upcode=mysqli_real_escape_string($conn,md5(rand()));
		if(!empty($upemail) && !empty($upmobile) && !empty($upname) && !empty($upfirstname))
		{
		if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE email='{$upemail}' and otp=' '"))>0){
			$msg="<div>{$email} - This email already exists</div>";
			
		}else{
		if($uppassword===$upcpassword)
			{
				$sql="INSERT INTO users(name,firstname,email,mobile,password,account,sex,otp) VALUES ('{$upname}','{$upfirstname}','{$upemail}','{$upmobile}',md5('{$uppassword}'),'{$upaccount}','{$upsex}','{$upcode}')"; 
				$result=mysqli_query($conn,$sql);
				if($result){
					echo "<div style='display:none>";
					//Create an instance; passing `true` enables exceptions
					$mail = new PHPMailer(true);

					try {
						//Server settings
						$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
						$mail->isSMTP();                                            //Send using SMTP
						$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
						$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
						$mail->Username   = 'caooochaooo@gmail.com';                     //SMTP username
						$mail->Password   = '9876543210caoo';                               //SMTP password
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
						$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

						//Recipients
						$mail->setFrom('caooochaooo@gmail.com');
						$mail->addAddress($upemail);
						//Content
						$mail->isHTML(true);                                  //Set email format to HTML
						$mail->Subject = 'no reply';
						$mail->Body    = 'Here is the verification link <b><a href="http://127.0.0.1:1337/?verification='.$upcode.'">http://127.0.0.1:1337/?verification='.$upcode.'</a></b>';

						$mail->send();
						echo 'Message has been sent';
					} catch (Exception $e) {
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
					echo "</div>";
					$msg="<div> We've send a verification link on your email address</div>";
				}
				else{
					$msg="<div>Something wrong went</div>";
				}
			}
		else
			{
			$msg="<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
			}
		}}		
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
		<title>Login and registration</title>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
	</head>
	<body>
		<div class="container">
			<input type="checkbox" id="flip" style='display:none'>
			<div class="cover"></div>
			<form action="" method="post">
				<div class="form-content">
					<div class="login-form">
					<div class="title">
						Se connecter
					</div>
					<?php {echo $msg ;if(isset($_POST['insubmit'])) {echo $msgin;}}?>
					<div class="input-boxes">
						<div class="input-box">
							<input type="text" class="inemail" name="inemail"placeholder="Email">
						</div>
						<div class="input-box">
							<input type="password" class="inpassword" name="inpassword" placeholder="Mot de passe">
						</div>
						<div class="text"><a href="forgot-password.php">Forgot password</a></div>
						<div class="button input-box">
							<input type="submit" name="insubmit" class="inbtn" value="Se connecter" >
						</div>
						<div class="text">
							Vous n'avez pas de compte? <label for="flip">S'inscrire maintenant</label>
						</div>
					</div>
					</div>
					
					<div class="signup-form">
						<div class="title">
						S'inscrire 
					</div>
					<?php if(isset($_POST['upsubmit'])) {echo $msg;}?>
					<div class="input-boxes">
						<div class="input-box">
							<input type="text" class="upname" name="upname" placeholder="Nom" value="<?php if(isset($_POST['upsubmit'])) {echo $upname;}?>">
						</div>
						<div class="input-box">
							<input type="text" class="upfirstname" name="upfirstname" placeholder="Prenom" value="<?php if(isset($_POST['upsubmit'])) {echo $upfirstname;}?>">
						</div>
						<div class="input-box">
							<input type="text" class="upemail" name="upemail" placeholder="Email" value="<?php if(isset($_POST['upsubmit'])) {echo $upemail;}?>">
						</div>
						<div class="input-box">
							<input type="number" class="upmobile" name="upmobile"placeholder="Mobile" value="<?php if(isset($_POST['upsubmit'])) {echo $upmobile;}?>">
						</div>
						<div class="input-box">
							<input type="password" class="uppassword" name="uppassword" placeholder="Mot de passe">
						</div>
						<div class="input-box">
							<input type="password" class="upcpassword" name="upcpassword" placeholder="Confirmer mot de passe">
						</div>
						<div id="select">							
							<label for="account">
							Type de Compte	
							</label>
							<select name="account" class="account_selected" >
								 
								<option value="client">
									Client
								</option>
								<option value="conducteur">
									Conducteur
								</option>
							</select>
						</div>
						<div id="select">							
							<label for="sex">
							Sexe
							</label>
							<select name="sex" class="sex_selected" >
								 
								<option value="masculin">
									Masculin
								</option>
								<option value="feminin">
									Feminin
								</option>
							</select>
						</div>
						<div class="button input-box">
							<input type="submit" name="upsubmit" value="S'inscrire">
						</div>
						<div class="text">
							Vous avez deja de compte?<label for="flip">Connecter vous</label>
						</div>
					<div/>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>