<?php
	session_start();	
	if(!isset($_SESSION['SESSION_EMAIL'])){
		header('Location: ../index.php');
		die();
	}
	include '../config.php';
	$query=mysqli_query($conn,"SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}' AND otp=' '");
	if(mysqli_num_rows($query)===1)
	{
		$row=mysqli_fetch_assoc($query);
		$name=$row['name'];
		$firstname=$row['firstname'];
		$email=$row['email'];
		$mobile=$row['mobile'];
		$account=$row['account'];
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Compte</title>
	<link rel="stylesheet" href="profile.css">	
</head>
<body>
	<section id="header">
		<!-- <a href="#"><img src="img/BeninTransport.png" class="logo" alt=""></a> -->
			<h1 href="#" class="logo">Benin Transport</h1>
			<div>
				<ul id="navbar">
					<li><a href="home.php">Home</a></li>
					<li><a href="services.php">Services</a>
						<ul class="submenu">
							<li><a href="go.php">Benin Taxi</a></li>
							<li><a href="go.php">Gozem</a></li>
						</ul>
					</li>
					<?php if($row['account']=='conducteur'){echo "<li><a href='positionactuel.php'>Actualiser position</a></li>";}?>
					<li><a href="messagerie.php">Historiques des trajets</a>
					<?php if($row['account']=='conducteur'){echo "<ul  class='submenu'><li><a href='commande.php'>Commandes recus</a></li>
																						<li><a href='validecond.php'>Validee commande recu</a></li>
					</ul>";}?>
					</li>
					<li><a href="msg.php">Notification</a></li>
					<li><a class="active" href="profil.php">Compte</a></li>
				</ul>
			</div>
	</section>
	<section class="pcontainer"> 
		<div class="rightside">
			<img src="img/account.png" class="userimg" width="150">
			<div class="optgroup">
				<h3><?php echo $firstname,' ',$name;?></h3>
				<a class="profilactive"href="profil.php">Voir profil</a>
				<a href="modifierprofil.php">Modifier profil</a>
				<a href="changeprofilmdp.php">Changer mot de passe</a>
				<a href="logout.php">Se deconnecter</a>						
			</div>
		</div>
		<div class="user">
			<div class="datanamegroup">
				<div class="dataname">
					<h4>Nom</h4>
				</div>
				<div class="dataname">
					<h4>Prenom</h4>
				</div>
				<div class="dataname">
					<h4>Email</h4>
				</div>
				<div class="dataname">
					<h4>Mobile</h4>
				</div>
				<div class="dataname">
					<h4>Compte</h4>
				</div>
			</div>
			<div class="datanamegroup">
				<div class="dataname">
					<h4><?php echo $name;?></h4>
				</div>
				<div class="dataname">
					<h4><?php echo $firstname;?></h4>
				</div>
				<div class="dataname">
					<h4><?php echo $email;?></h4>
				</div>
				<div class="dataname">
					<h4><?php echo $mobile;?></h4>
				</div>
				<div class="dataname">
					<h4><?php echo $account;?></h4>
				</div>
			</div>
		</div>
	</section>
	<footer class="section-p1">
		<div class="col">
			<h1>Benin Transport</h1>
			<h4>Contact</h4>
			<p><strong>Address:</strong> Universite Abomey,Sogbo-Aliho,Abomey</p>
			<p><strong>Phone:</strong>+229 66 81 61 89/+229 97 06 84 57</p>
			<p><strong>Hours:</strong>00:00 - 24:00,Mon - Sun</p>
			<div class="follow">
				<h4>Suivez nous</h4>
				<div class="icon">
					<i><img src="img/icon/facebook.ico" alt=""></i>
					<i><img src="img/icon/twitter.ico" alt=""></i>
					<i><img src="img/icon/instagram.ico" alt=""></i>
					<i><img src="img/icon/youtube.ico" alt=""></i>
				</div>
			</div>
			<div class="copyright">
				<p>?? 2022,BENIN Transport</p>
			</div>
		</div>	
		<div class="col">
			<h4>A propos</h4>
			<a href="#">A propos de nous</a>
			<a href="#">Politique de confidentialit??</a>
			<a href="#">Termes et conditions</a>
			<a href="href=mailto:carickren@gmail.com">Contactez nous</a>
		</div>
		<div class="col">
			<h4>My Account</h4>
			<a href="profil.php">Mon Compte</a>
			<a href="go.php">Regarder la carte</a>
			<a href="go.php">Reservation</a>
			<a href="#">Termes et conditions</a>
			<a href="mailto:carickren@gmail.com">Contactez nous</a>
		</div>
	</footer>
</body>
</html>