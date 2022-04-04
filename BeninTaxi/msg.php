<?php
	session_start();	
	if(!isset($_SESSION['SESSION_EMAIL'])){
		header('Location: ../index.php');
		die();
	}
	include '../config.php';
	$start=0;
	$perpage=10;
	$record="";
	$page="";
	$current_page=1;
	$note=0;
	$userid="";
	$query=mysqli_query($conn,"SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}' AND otp=' '");
	if(mysqli_num_rows($query)===1)
	{
		$row=mysqli_fetch_assoc($query);
		$userid=$row['id'];
		if(isset($_GET['start'])){
			echo $record;
			$start=$_GET['start'];
			$current_page=$start;
			$start--;
			$start=$start*$perpage;
		}
		$query2=mysqli_query($conn,"SELECT * FROM reservation WHERE userid='{$userid}' AND note='0' AND reservalid='1' ORDER BY id DESC");
		if(isset($_POST['validenote']))
		{
			while($row2=mysqli_fetch_assoc($query2))
			{
				$id=$row2['id'];
				if($_POST[$id]!="0")
				{
					$query3=mysqli_query($conn,"SELECT * FROM conducteur WHERE condid='{$row2['conducid']}'");
					$row3=mysqli_fetch_assoc($query3);
					if($row2['typeconducteur']==='lent')
					{
						$note=(($row3['qualitelent']*$row3['countlentnote'])+((int)$_POST[$row2['id']]))/(($row3['countlentnote'])+1);
						if($note)
						{
							$countlent=($row3['countlentnote'])+1;
							$query4=mysqli_query($conn,"UPDATE conducteur set countlentnote='{$countlent}',qualitelent='{$note}' WHERE condid='{$row2['conducid']}'");
							if($query4)
							{
								$query5=mysqli_query($conn,"UPDATE reservation set note='1' WHERE id='{$row2['id']}'");
							}
						}
					}
					if($row2['typeconducteur']==='rapide')
					{
						$note=(($row3['qualiterapide']*$row3['countrapidenote'])+((int)$_POST[$row2['id']]))/(($row3['countrapidenote'])+1);
						if($note)
						{
							$countrapide=($row3['countrapidenote'])+1;
							$query4=mysqli_query($conn,"UPDATE conducteur set countrapidenote='{$countrapide}',qualiterapide='{$note}' WHERE condid='{$row2['conducid']}'");
							if($query4)
							{
								$query5=mysqli_query($conn,"UPDATE reservation set note='1' WHERE id='{$row2['id']}'");
							}
						}
					}
					
				}
			}
		}
		
		$record=mysqli_num_rows($query2);
		$query1=mysqli_query($conn,"SELECT * FROM reservation WHERE userid='{$userid}' AND note='0' AND reservalid='1' ORDER BY id DESC limit $start,$perpage");
		$page=ceil($record/$perpage);
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Transport services</title>
	<link rel="stylesheet" href="msg.css">	
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
				<li><a  class="active" href="msg.php">Notification</a></li>
				<li><a href="profil.php">Compte</a></li>
			</ul>
		</div>
	</section>
	<section id="containernote">
		<form method='POST' action="">
			<h2 style="text-align:center;padding:10px">Notification</h2>
			<?php while($row1=mysqli_fetch_assoc($query1)){?>
			<div class="ligne">
				<div class="msg">
					<p>Le conducteur de la reservation effectue le <?php echo $row1['date'];?> a termine sa course<br>Veuillez le note sur la qualite de votre commande</p>
				</div>
				<div class="note">
					<select name="<?php echo $row1['id'];?>" class="selectvalue">					
						<option value="0" selected>-Note sur 100-</option>
						<?php for($j=1;$j<=100;$j++){?>
						<option value="<?php echo $j;?>"><?php echo $j;?></option>
						<?php }?>
					<!--	<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
						<option value="32">32</option>
						<option value="33">33</option>
						<option value="34">34</option>
						<option value="35">35</option>
						<option value="36">36</option>
						<option value="37">37</option>
						<option value="38">38</option>
						<option value="39">39</option>
						<option value="40">40</option>
						<option value="41">41</option>
						<option value="42">42</option>
						<option value="43">43</option>
						<option value="44">44</option>
						<option value="45">45</option>
						<option value="46">46</option>
						<option value="47">47</option>
						<option value="48">48</option>
						<option value="49">49</option>
						<option value="50">50</option>
						<option value="51">51</option>
						<option value="52">52</option>
						<option value="53">53</option>
						<option value="54">54</option>
						<option value="55">55</option>
						<option value="56">56</option>
						<option value="57">57</option>
						<option value="58">58</option>
						<option value="59">59</option>
						<option value="60">60</option>
						<option value="61">61</option>
						<option value="62">62</option>
						<option value="63">63</option>
						<option value="64">64</option>
						<option value="65">65</option>
						<option value="66">66</option>
						<option value="67">67</option>
						<option value="68">68</option>
						<option value="69">69</option>
						<option value="70">70</option>
						<option value="71">71</option>
						<option value="72">72</option>
						<option value="73">73</option>
						<option value="74">74</option>
						<option value="75">75</option>
						<option value="76">76</option>
						<option value="77">77</option>
						<option value="78">78</option>
						<option value="79">79</option>
						<option value="8">80</option>
						<option value="81">81</option>
						<option value="82">82</option>
						<option value="83">83</option>
						<option value="84">84</option>
						<option value="85">85</option>
						<option value="86">86</option>
						<option value="87">87</option>
						<option value="88">88</option>
						<option value="89">89</option>
						<option value="90">90</option>
						<option value="91">91</option>
						<option value="92">92</option>
						<option value="93">93</option>
						<option value="94">94</option>
						<option value="95">95</option>
						<option value="96">96</option>
						<option value="97">97</option>
						<option value="98">98</option>
						<option value="99">99</option>
						<option value="100">100</option>-->
					</select>
				</div>
		<br></div>
			<?php }?>
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
				<input type="submit" name="validenote" value="Confirmer les notes">
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