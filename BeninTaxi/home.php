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
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Transport services</title>
	<link rel="stylesheet" href="acceuil.css">	
</head>
<body>
	<section id="header">
		<!-- <a href="#"><img src="img/BeninTransport.png" class="logo" alt=""></a> -->
		<h1 href="#" class="logo">Benin Transport</h1>
		<div>
			<ul id="navbar">
				<li><a class="active" href="home.php">Home</a></li>
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
				<li><a href="profil.php">Compte</a></li>
			</ul>
		</div>
	</section>	
	<section id="hero">
		<h4>Vous êtes sur la plateforme de transport du Bénin</h4>
		<h2>Nous réalisons vos transports</h2>
		<h1>De maniere Rapide, sécurisé et abordable</h1>
		<p>Économisez plus jusqu'à 10% avec nos services</p>
	</section>
	<section id="services" >
		<div class="servicetitle"><h2>Services Disponibles</h2></div>
		<div class="servicesbloc" >
			<div class="gozem">
				<img src="img/gozem.png" alt="">
			</div>
			<div class="servicesdescription" id="gozembloc">
				<p>Gozem est connu pour être "Africa's Super App". Opérationnel dans l’Afrique de l’Ouest et Centrale, nous fournissons à des centaines de milliers d'utilisateurs de la région diverses solutions de transport, de livraison et de paiement sans espèces à la demande dans une seule application.</p>
				<div class="gozemset"><a href="go.php"><input type="submit" name="gozemset" value="Utiliser Gozem"></div></a>
			</div>
		</div>
		<div class="servicesbloc" >
			<div class="benintaxi">
				<img src="img/benintaxi.jpg" alt="">
			</div>
			<div class="servicesdescription" id="taxibeninbloc">
				<p>Pour vos courses et vos déplacements ainsi que la location de taxi à l'intérieur du Bénin faites vite votre réservation au 97296020 ou au 95849737. Votre taxi au service de tous. Nous sommes ponctuels et joviales. La satisfaction du client est notre soucis majeur. Nos tarifs sont imbattables. Nous faisons des réductions sur les locations. Nos véhicules sont confortables et climatisées. Bénin Taxi est à votre disposition 24h / 24. Bénin Taxi c'est la rapidité, la sûreté et très confortable.</p>
				<div class="benintaxiset"><a href="go.php"><input type="submit" name="benintaxiset" value="Utiliser Benin Taxi"></div></a>
			</div>
		</div>
	</section>
	<section id="feature" class="section-p1">
		<h2>Payez avec</h2>
		<div class="fe-box">
			<img src="img/features/mtnmomo.png" alt="">
			<h6>Mtn MoMo</h6>
		</div>
		<div class="fe-box1">
			<img src="img/features/moovmoney.jpg" alt="">
			<h6>Moov Money</h6>
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
				<p>© 2022,BENIN Transport</p>
			</div>
		</div>	
		<div class="col">
			<h4>A propos</h4>
			<a href="#">A propos de nous</a>
			<a href="#">Politique de confidentialité</a>
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