<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');

$bdd = new PDO('mysql:host=127.0.0.1;dbname=b-site-e-commerce','root','');
 
 if (isset($_POST['submit'])) {
 	    $username = htmlspecialchars($_POST['username']);
 		$email = htmlspecialchars($_POST['email']);
 		$email2 = htmlspecialchars($_POST['email2']);
 		$mdp = sha1($_POST['mdp']);
 		$mdp2 = sha1($_POST['mdp2']);
 	if (!empty($_POST['username']) AND !empty($_POST['email']) AND!empty($_POST['email2']) AND!empty($_POST['mdp']) AND !empty($_POST['mdp2']) ) {

 		$usernamelength=strlen($username);
 		if ($usernamelength <=255) {
 			if ($email==$email2) {
 				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
 					$reqmail = $bdd->prepare("SELECT * FROM users WHERE email=?");
 					$reqmail->execute(array($email));
 					$mailexist = $reqmail->rowCount();
 					if ($mailexist == 0) {
 
 					if ($mdp==$mdp2) {
 					$insertmbr= $bdd->prepare("INSERT INTO users(username,email,password)VALUES(?,?,?) ");
 					$insertmbr->execute(array($username,$email,$mdp));
 					$erreur="Votre compte a bien été créé! <a href=\" connect.php\">Me connecter</a> ";
 				}else{ $erreur= "Vos mots de passes ne correspondent pas !";}
 			}else{ $erreur="Adresse mail déjà utilisée !";}
 			}else{ $erreur="Votre adresse mail n'est pas valide !"; }
 			}else{ $erreur= "Vos adresses mail ne correspondent pas !";}
 		}else{ $erreur = "Votre username ne doit pas dépasser 255 caractéres." ;}
 	}else { $erreur= "Tous lees champs doivent être complétés !";}
 }

?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			background: url("style/regAZD.png") no-repeat; background-size: 100%;}
		section{text-align: right;  width: 875px; height: 680px; }
		
		section div img{width: 120px; height: 120px; margin-left: 3px;}
	</style>
	 <link rel="icon" type="image/x-icon" href="style/1111.png">
	<title>Inscription</title>
	<meta charset="utf-8">
</head>
<body> 
	<?php
		if (isset($erreur)) {
			echo '<font color="red">'. $erreur ."</font>";
		}
		?>
	<div style="margin-left: 365px"></br></br>
		&nbsp&nbsp&nbsp&nbsp<img src="style/Sans titre.png" >
		<h2>&nbsp&nbsp&nbsp&nbsp Inscription</h2> 
		
		<form method="POST" action="">
			<table >
				<tr>
					
					<td><input type="text" placeholder="Votre pseudo" id="username" name="username" value="<?php if(isset($username)){echo $username;} ?>"></td>
				</tr>
			
				<tr>
					
					<td><input type="email" placeholder="Votre email" id="email" name="email"  value="<?php if(isset($email)){echo $email;} ?>"></td>
				</tr>

				<tr>
					
					<td><input type="email" placeholder="Confirmez votre email" id="email2" name="email2" value="<?php if(isset($email2)){echo $email2;} ?>"></td>
				</tr>

				<tr>
					
					<td><input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"></td>
				</tr>

				<tr>
					<td><input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2"></td>
				</tr>
			</table></br> &nbsp&nbsp&nbsp&nbsp <input type="submit" name="submit" value="Je m'inscris"/><input type="reset" value="Effacer" required/><br/><br/>
			&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp <a href="connect.php">Se connecter</a>
		</form>
		
	</div>
<?php


require_once('includes/footer.php');

?>
</body>
</html>
