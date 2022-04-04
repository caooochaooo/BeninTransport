<?php
	$msg="";
	session_start();
	if(isset($_SESSION['SESSION_EMAIL'])){
		header('Location: BeninTaxi/home.php');
		die();
	}
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	//Load Composer's autoloader
	require 'vendor/autoload.php';
	include 'config.php';
	if(isset($_POST['insubmit']))
	{
		$inemail=mysqli_real_escape_string($conn,$_POST['inemail']);
		$upcode=mysqli_real_escape_string($conn,md5(rand()));
		if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE email='{$inemail}'"))>0)
		{
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
				$mail->addAddress($inemail);
				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'no reply';
				$mail->Body    = 'Here is the verification link <b><a href="http://127.0.0.1:1337/change-password.php/?reset='.$upcode.'">http://127.0.0.1:1337/change-password.php/reset='.$upcode.'</a></b>';

				$mail->send();
				echo 'Message has been sent';
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
			$msg="<div> We've send a verification link on your email address</div>";
			echo "</div>";
			$query=mysqli_query($conn,"UPDATE users SET otp='{$upcode}' WHERE email='{$inemail}'");
	
		}
		else{
			$msg="<div>$inemail  not found</div>";
		}
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
					Mot de passe oublie
				</div>
				<?php echo $msg;?>
				<div class="input-boxes">
					<div class="input-box">
						<input type="text" class="inemail" name="inemail"placeholder="Email">
					</div>
					<div class="button input-box">
						<input type="submit" name="insubmit" class="inbtn" value="Envoyer le lien de recuperation" >
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