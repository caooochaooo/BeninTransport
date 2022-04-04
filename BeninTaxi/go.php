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
	function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
		$theta = $longitudeFrom - $longitudeTo;
		$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$distance = ($miles * 1.609344);
		return $distance;
	}
	$date=date_default_timezone_set('Africa/Porto-Novo');
	$date = date('Y-m-d H:i:s');
	if(isset($_POST['fromlat']))
	{
		$departlat=$_POST['fromlat'];
	}
	if(isset($_POST['fromlng']))
	{
		$departlng=$_POST['fromlng'];
	
	}
	if(isset($_POST['tolat']))
	{
		$arrivelat=$_POST['tolat'];
	
	}
	if(isset($_POST['tolng']))
	{
		$arrivelng=$_POST['tolng'];
	
	}
	if((isset($_POST['btndistance'])) || (isset($_POST['btnreserve'])))
	{
		$distances=distance($departlat,$departlng,$arrivelat,$arrivelng);
	}	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Transport services</title>
	<link rel="stylesheet" href="sevgozem.css">		
	<script src="sevigozem.js"></script>
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
	<section>
		<div class="jumbotron">
			<div class="container-fluid">
				<h1>Itineraire</h1>
				<p>Determination de la distance de votre itineraire</p>
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<div class="point">
						<h4>Point de depart</h4>	
							<div class="inputcoord">
								<input type="text" id="fromlat" placeholder="latitude de depart" name="fromlat" class="form-control" value="<?php if(isset($_POST['btndistance'])){echo $departlat;}?>">
								<input type="text" id="fromlng" placeholder="longitude de depart" name="fromlng" class="form-control" value="<?php if(isset($_POST['btndistance'])){echo $departlng;}?>">
							</div>
						</div>						
						<div class="point">
						<h4>Point d'arrive</h4>
						<div class="inputcoord">
								<input type="text" id="tolat" placeholder="latitude d'arrive" name="tolat" class="form-control" value="<?php if(isset($_POST['btndistance'])){echo $arrivelat;}?>">
								<input type="text" id="tolng" placeholder="longitude d'arrive" name="tolng" class="form-control" value="<?php if(isset($_POST['btndistance'])){echo $arrivelng;}?>">
							</div>						
						</div>	
					<!--<div id="select">							
							<label for="maptype">
							Map type
							</label>
							<select name="maptype" id="map_selected" >
								 
								<option value="etablishment">
									etablishment
								</option>
								<option value="address">
									address
								</option>
								<option value="geocode">
									geocode
								</option>
								<option value="(cities)">
									(cities)
								</option>
								<option value="(regions)">
									(regions)
								</option>
							</select>
						</div>-->
					</div>
					<div class="btndiv">
						<input type="submit" class="btndistance" name="btndistance" value="distance">
					</div>
					<div class="makecommand"><?php if((isset($_POST['btndistance'])) && (!empty($distances))){echo "<input class='makecmd' type='submit' name='btnreserve' value='Faire la reservation'>";}?></div>
				</form>
				<?php
					if(isset($_POST['btnreserve']))
						{		
							$userid=$row['id'];
							$query1=mysqli_query($conn,"INSERT INTO reservation(userid,latitudefrom,longitudefrom,latitudeto,longitudeto,distance,date) VALUES ('{$userid}','{$departlat}','{$departlng}','{$arrivelat}','{$arrivelng}','{$distances}','{$date}')");
							if($query1)
							{
								header("Location: reserve.php");
							}						
						}
				?>
				<div class="distance"><?php if(isset($_POST['btndistance'])){echo "La distance de votre trajet est ".$distances." km";};?></div>
			</div>
			<div class="container-fluid2">
				<div id="googleMap">
					
				</div>
			</div>
		</div>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7XVR9wt1sMCm6mJAR9B8VeNS5lM1kARU&callback=initMap"></script>
		
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