<?php
	session_start();	
	if(!isset($_SESSION['SESSION_EMAIL'])){
		header('Location: ../index.php');
		die();
	}
	include '../config.php';
	$query=mysqli_query($conn,"SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}' and otp=' '");
	$row=mysqli_fetch_assoc($query);
	$query2=mysqli_query($conn,"SELECT * FROM reservation ORDER BY id DESC");
	$row2=mysqli_fetch_assoc($query2);
	$query5=mysqli_query($conn,"SELECT * FROM distance WHERE reservid ='{$row2['id']}' ORDER BY CAST(dst AS DECIMAL(18,9))");
	$i=1;
	if(isset($_POST['validecond']))
	{
		if(isset($_POST['1']))
		{			
			$query4=mysqli_query($conn,"UPDATE reservation set conducid='{$_POST['1']}' WHERE id='{$row2['id']}'");
			$query6=mysqli_query($conn,"UPDATE conducteur set disponible='0' WHERE condid='{$_POST['1']}'");
			header('Location: messagerie.php');
		}	
		/*if(isset($_POST['2']))
		{			
			$query4=mysqli_query($conn,"UPDATE reservation set conducid='{$_POST['2']}' WHERE id='{$row2['id']}'");
		}	
		if(isset($_POST['3']))
		{			
			$query4=mysqli_query($conn,"UPDATE reservation set conducid='{$_POST['3']}' WHERE id='{$row2['id']}'");
		}	
		if(isset($_POST['4']))
		{			
			$query4=mysqli_query($conn,"UPDATE reservation set conducid='{$_POST['4']}' WHERE id='{$row2['id']}'");
		}	
		if(isset($_POST['5']))
		{			
			$query4=mysqli_query($conn,"UPDATE reservation set conducid='{$_POST['5']}' WHERE id='{$row2['id']}'");
		}*/
	}
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Transport services</title>
	<link rel="stylesheet" href="choixconduc.css">	
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
	<section id="choix" >
		<form action="" method='post'>
			<div><h4>Note des conducteurs de <?php if($row2['typevehicule']=="vehiculesimple"){echo " <strong>Vehicules simples  </strong>";}if($row2['typevehicule']=="vehiculeclimatise"){echo " <strong>Vehicules climatises  </strong>";}if($row2['typevehicule']=="taximoto"){echo " <strong>Taxis motos  </strong>";}?>proches de vous selon leur <?php if($row2['typeconducteur']=="lent"){echo " <strong>Lenteur</strong>";}if($row2['typeconducteur']=="rapide"){echo " <strong>Rapidite</strong>";}?></h4></div>
			<div class="cchoix">
				<div>Nom du conducteur</div>
				<div>Point</div>
				<div>Distance</div>
			</div>
			<?php while($row5=mysqli_fetch_assoc($query5)){
				$query7=mysqli_query($conn,"SELECT * FROM conducteur WHERE condid='{$row5['condid']}'");
				$row7=mysqli_fetch_assoc($query7);
				if($row7['mconducteur']==$row2['typevehicule'])
				{
					$query3=mysqli_query($conn,"SELECT * FROM users WHERE id='{$row5['condid']}'");
					$row3=mysqli_fetch_assoc($query3);
					$query1=mysqli_query($conn,"SELECT * FROM conducteur WHERE condid='{$row5['condid']}'");
					$row1=mysqli_fetch_assoc($query1);
			?>
			<div class="cchoix">
				<div class="condchoisi">
					<input type="radio" name="<?php echo $i;?>" id="<?php echo $row3['name'];?>" value="<?php echo $row1['condid'];?>" class="selectcond">	
					<label for="<?php echo $row3['name'];?>"><?php echo '<strong>'.$row3['name'].'  '.$row3['firstname'].'</strong>';?></label>
				</div>
				<div>
					<div>
						<?php if($row2['typeconducteur']=="lent"){echo "<strong>".$row1['qualitelent']."</strong>";}if($row2['typeconducteur']=="rapide"){echo "<strong>".$row1['qualiterapide']."</strong>";}?>
					</div>
				</div>
				<div class="distance">
				<?php echo "<strong>".round($row5['dst'],3)." KM</strong>";?>
				</div>
			</div>
				<?php }}?>			
			<div class="validecond">
				<input type="submit" name="validecond" value="Confirmer le conducteur">
			</div>
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