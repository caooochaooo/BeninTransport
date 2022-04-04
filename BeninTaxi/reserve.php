<?php
	session_start();	
	if(!isset($_SESSION['SESSION_EMAIL'])){
		header('Location: ../index.php');
		die();
	}
	include '../config.php';
	function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
		$theta = $longitudeFrom - $longitudeTo;
		$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$distance = ($miles * 1.609344);
		return $distance;
	}
	$query=mysqli_query($conn,"SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}' AND otp=' '");
	$row=mysqli_fetch_assoc($query);
	$typeconducteur="";
	$typevehicule="";
	$montant="";
	if(mysqli_num_rows($query)===1)
	{
		$userid=$row['id'];
		$query1=mysqli_query($conn,"SELECT * FROM reservation WHERE userid='{$userid}' ORDER BY id DESC");
		$row1=mysqli_fetch_assoc($query1);
		$id=$row1['id'];
		$dist=$row1['distance'];
		if(isset($_POST['mtransport']))
		{
			$typevehicule=$_POST['mtransport'];
		}	
		if(isset($_POST['tconducteur']))
		{
			$typeconducteur=$_POST['tconducteur'];
		}
		if($typeconducteur=='rapide') 
		{
			if($typevehicule=='vehiculesimple')
			{
				$montant=$dist*100;
			}
			if($typevehicule=='vehiculeclimatise')
			{
				$montant=$dist*150;
			}
			if($typevehicule=='taximoto')
			{
				$montant=$dist*50;
			}
		}
		if($typeconducteur=='lent') 
		{
			if($typevehicule=='vehiculesimple')
			{
				$montant=$dist*150;
			}
			if($typevehicule=='vehiculeclimatise')
			{
				$montant=$dist*200;
			}
			if($typevehicule=='taximoto')
			{
				$montant=$dist*70;
			}
		}
		if(isset($_POST['valide']) && $_POST['valide']=="valide")
		{
			$query2=mysqli_query($conn,"UPDATE reservation set typevehicule='{$typevehicule}',typeconducteur='{$typeconducteur}',montant='{$montant}' WHERE id='{$id}' ");
			if($query2)
			{
				$query3=mysqli_query($conn,"SELECT * FROM conducteur WHERE disponible='1' and mconducteur='{$typevehicule}'");
				while($row3=mysqli_fetch_assoc($query3))
				{
					$conduclat=$row3['clat'];
					$conduclng=$row3['clng'];
					$clientlat=$row1['latitudefrom'];
					$clientlng=$row1['longitudefrom'];
					$space=distance($clientlat,$clientlng,$conduclat,$conduclng);
					if(!empty($space))
					{
						$conducid=$row3['condid'];
						// $query4=mysqli_query($conn,"UPDATE conducteur set clientdst='{$space}' WHERE condid='{$conducid}'");
					$query5=mysqli_query($conn,"INSERT INTO distance(reservid,condid,dst) VALUES ('{$id}','{$conducid}','{$space}')");
					}
				}				
				header("Location: choixconduc.php");
				}
		}	
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Compte</title>
	<link rel="stylesheet" href="reserves.css">	
</head>
<body>
	<section id="header">
		<!-- <a href="#"><img src="img/BeninTransport.png" class="logo" alt=""></a> -->
			<h1 href="#" class="logo">Benin Transport</h1>
			<div>
				<ul id="navbar">
					<li><a href="home.php">Home</a></li>
					<li><a class="active" href="services.php">Services</a>
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
	<section class="reserve">
		<form action="" method="post">
			<div class="transports">
				<label for="mtransport">Moyens de Transport</label>
				<select name="mtransport" class="moyensdetransport">
					<option >---Choisissez---</option>
					<option value="vehiculesimple" <?php if (isset($_POST['mtransport']) && $_POST['mtransport']=="vehiculesimple") echo "selected";?>>Vehicule Simple</option>
					<option value="vehiculeclimatise" <?php if (isset($_POST['mtransport']) && $_POST['mtransport']=="vehiculeclimatise") echo "selected";?>>Vehicule climatise</option>
					<option value="taximoto" <?php if (isset($_POST['mtransport']) && $_POST['mtransport']=="taximoto") echo "selected";?>>Taxi Moto</option>
				</select>
			</div>
			<div class="transports">
				<label for="tconducteur">Type de Conducteur</label>
				<select name="tconducteur" class="moyensdetransport">
					<option >---Choisissez---</option>
					<option value="rapide" <?php if (isset($_POST['tconducteur']) && $_POST['tconducteur']=="rapide") echo "selected";?>>Efficace Rapide</option>
					<option value="lent" <?php if (isset($_POST['tconducteur']) && $_POST['tconducteur']=="lent") echo "selected";?>>Lent et doux</option>
				</select>
			</div>		
			<div class="transports">
				<h4 style="width:40%"><?php
						if(($typeconducteur=="lent") && ($typevehicule=="vehiculesimple"))
						{
							echo"Le montant pour un vehicule simple et un conducteur lent et doux est ";
						}
						if(($typeconducteur=="lent") && ($typevehicule=="vehiculeclimatise"))
						{
							echo"Le montant pour un vehicule climatise et un conducteur lent et doux est ";
						}
						if(($typeconducteur=="lent") && ($typevehicule=="taximoto"))
						{
							echo"Le montant pour un taximoto et un conducteur lent et doux est ";
						}
						if(($typeconducteur=="rapide") && ($typevehicule=="vehiculesimple"))
						{
							echo"Le montant pour un vehicule simple et un conducteur efficace et rapide est ";
						}
						if(($typeconducteur=="rapide") && ($typevehicule=="vehiculeclimatise"))
						{
							echo"Le montant pour un vehicule climatise et un conducteur efficace et rapide est ";
						}
						if(($typeconducteur=="rapide") && ($typevehicule=="taximoto"))
						{
							echo"Le montant pour un taximoto et un conducteur efficace et rapide est ";
						}
					?>
				</h4>
				<h4><?php echo "<strong>".round((float)$montant,2)." FCFA</strong>";?></h4>
			</div>
		<!--	<div class="transports">
				<div><h4>Option de payement</h4></div>
				<div class="pay">
					<input type="radio" name="pay" value="Payez avec Mtn MoMo">
					<i><img src="img/features/mtnmomo.png" alt=""></i>
				</div>
				<div class="pay">
					<input type="radio" name="pay" value="Payez avec Moov Money">
					<i><img src="img/features/moovmoney.jpg" alt=""></i>
				</div>
			</div>-->
			<div class="valid"><input type="submit" name="valide" value="<?php if(!isset($_POST['valide'])){echo "Voir le montant";}else{echo "valide";}?>" class="valide"></div>
		</form>
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