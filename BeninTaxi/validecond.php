<?php
	session_start();	
	if(!isset($_SESSION['SESSION_EMAIL'])){
		header('Location: ../index.php');
		die();
	}
	include '../config.php';
	$i=1;
	$start=0;
	$perpage=10;
	$record="";
	$page="";
	$current_page=1;	
	$query=mysqli_query($conn,"SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}' and otp=' ' and account='conducteur'");
	if($query)
	{
		if(mysqli_num_rows($query)===0)
		{
			header("Location: home.php");
			die;
		}
		$row=mysqli_fetch_assoc($query);
		$conducid=$row['id'];
		if(isset($_GET['start'])){
			echo $record;
			$start=$_GET['start'];
			$current_page=$start;
			$start--;
			$start=$start*$perpage;
		}
		$record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM reservation WHERE conducid='{$conducid}' AND reservalid='0' ORDER BY id DESC"));
		$query1=mysqli_query($conn,"SELECT * FROM reservation WHERE conducid='{$conducid}' AND reservalid='0' ORDER BY id DESC limit $start,$perpage");
		$page=ceil($record/$perpage);
		if( isset($_POST['1'])){
			if(isset($_POST['validereserve']))
			{
				$reserid=$_POST['1'];
				$query3=mysqli_query($conn,"UPDATE reservation set reservalid='1' WHERE id='{$reserid}'");
				$query4=mysqli_query($conn,"UPDATE conducteur set disponible='1' WHERE condid='{$conducid}'");
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
	<title>Transport services</title>
	<link rel="stylesheet" href="validecond.css">	
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
																						<li><a class='active' href='validecond.php'>Validee commande recu</a></li>
					</ul>";}?>
				</li>
				<li><a href="msg.php">Notification</a></li>
				<li><a href="profil.php">Compte</a></li>
			</ul>
		</div>
	</section>
	<section>
		<form action="" method='post' class="historique">
			<h2 style="padding-bottom:50px">Valide les commandes teminees</h2>
			<div class="hh">
				<h4>Date</h4>
				<h4 style="font-size:15px;">Coordonnee(lat/long) de depart</h4>
				<h4 style="font-size:15px;">Coordonnee(lat/long) d'arrivee</h4>
				<h4>Distance du trajet</h4>
				<h4>Montant du trajet</h4>
				<h4>Vehicule choisi</h4>
				<h4>Conducteur choisi</h4>
			</div>
			<div class="hset">
				<?php while($row1=mysqli_fetch_assoc($query1)){?>
				<div class="reserline">
					<input type="radio" id="<?php echo $row1['id'];?>" name="<?php echo $i;?>" value="<?php echo $row1['id'];?>">
					<label for=<?php echo $row1['id'];?>>
						<h4><?php echo $row1['date']?></h4>
						<h4><?php echo round($row1['latitudefrom'],4)."/".round($row1['longitudefrom'],4);?></h4>
						<h4><?php echo round($row1['latitudeto'],4)."/".round($row1['longitudeto'],4);?></h4>
						<h4 ><?php echo round($row1['distance'],4)." KM";?></h4>
						<h4 ><?php if(!empty($row1['montant'])){echo round($row1['montant'],2)." FCFA";}else{echo $row1['montant']." FCFA";}?></h4>
						<h4 ><?php if($row1['typevehicule']=="vehiculesimple"){echo "Vehicule Simple";}if($row1['typevehicule']=="vehiculeclimatise"){echo "Vehicule Climatise";}if($row1['typevehicule']=="taximoto"){echo "Taxi-Moto";}?></h4>
						<h4><?php if($row1['typeconducteur']=="rapide"){echo "Rapide et Efficace";}if($row1['typeconducteur']=="lent"){echo "Lent et doux";}?></h4><br>
					</label>
				</div>
				<?php }?>
			</div>
			<div class="pageset">
				<?php 
				if(mysqli_num_rows($query1)>0)
				{
					for($i=1;$i<=$page;$i++){
					$class='';
					if($current_page==$i){
						$class='at';
					}	?>
					<a class="pset <?php echo $class?>" href="?start=<?php echo $i;?>"><?php echo $i;?></a>				
				<?php }}else{?>Information indisponible<?php }?>
			</div>
			<div class="validecond">
				<input type="submit" name="validereserve" value="Valide la fin de la reservation">
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