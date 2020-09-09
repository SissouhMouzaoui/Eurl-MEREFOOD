<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');

$bdd = new PDO('mysql:host=127.0.0.1;dbname=B-site-e-commerce','root','');

if (isset($_POST['submit'])) {
	$mailconnect=htmlspecialchars($_POST['mailconnect']);
    $mdpconnect =sha1($_POST['mdpconnect']);
    if (!empty($mailconnect) and !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM users WHERE email=? and Password=?");
      $requser->execute(array($mailconnect,$mdpconnect));
      $userexist = $requser->rowCount();
      if ($userexist==1) {
      	$userinfo = $requser->fetch();
      	$_SESSION['id']=$userinfo['id'];
      	$_SESSION['username']=$userinfo['username'];
      	$_SESSION['email']=$userinfo['email'];
      	header("Location:my_account.php?id=".$_SESSION['id']);
      }else{ $erreur="Mauvais mail ou mot de passe !";}
    }else{ $erreur="Tous les champs doivent être complétés !";}
}


#AV2FR5S8G66HDR66LI5
   ?>
<head>
	<style type="text/css">
		body{
			background: url("style/conneAZD (2).png") no-repeat; background-size: 100%;}
		section{text-align: right;  width: 875px; height: 680px; }
		
		section div img{width: 120px; height: 120px; margin-left: 3px;}
	</style>
	 <link rel="icon" type="image/x-icon" href="style/1111.png">
	<title>Se connecter</title>
	<meta charset="utf-8">
</head>
<?php
		if (isset($erreur)) {
			echo '<font color="red">'. $erreur ."</font>";
		}
		?>

<section class="slider">
    <br/> <br/>
  	<div class="box" align="center">  
  		<img src="style/Sans titre.png" ><br/>
<h1>Se connecter</h1>

<form action="" method="POST">
	<h4>Votre email : <br/><input type="email" name="mailconnect" placeholder="Email" /> </h4>
	<h4>Votre mot-de-passe : <br/><input type="password" name="mdpconnect" placeholder="Password" /> </h4>
	<input type="submit" name="submit"/>  <input type="reset" value="Effacer" required/><br/>
	<br/>
<a href="register.php">S'inscrire</a>

</form></div></section>


<?php

require_once('includes/footer.php');

?>