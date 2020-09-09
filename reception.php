<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');

$bdd = new PDO('mysql:host=127.0.0.1;dbname=b-site-e-commerce','root','');

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {

$msg = $bdd->prepare('SELECT * FROM messages WHERE id_destinataire = ?  ORDER BY id DESC');
$msg->execute(array($_SESSION['id']));
$msg_nbr = $msg->rowCount();

?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
          body{  background: url("style/messAZD.png") no-repeat; background-size: 100%;}
           div a.tt { padding: 7px 30px; background-color: #d3dae6; color: #404f69;  border-radius: 5px; text-align: center;}
         div a.tt:hover{background-color:#404f69; color: #d3dae6; }
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
	<title>Boite de réception</title>
	<meta charset="utf-8">
</head>
<body> 
	<div  align="center">
    </br></br>  <a class="tt" href="my_account.php?id=<?= $_SESSION['id'] ?>"> Profil</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a class="tt" href="envoi.php"> Nouveau message</a> </br>
     <h1>Votre boite de réception :</h1> 
	<?php
	if ($msg_nbr == 0) {
		echo "Vous n'avez aucun message...";
	}
       while ($m = $msg->fetch()) {
       	$p_exp = $bdd->prepare('SELECT username FROM users WHERE id = ?');
       	$p_exp->execute(array($m['id_expediteur']));
       	$p_exp = $p_exp->fetch();
       	$p_exp = $p_exp['username'];
	?>
	
	<a href="lecture.php?id=<?= $m['id'] ?>"  <?php if ($m['lu'] == 1) { ?><span style="color:black"> <?php } ?> <b> <?= $p_exp  ?></b> &nbsp&nbsp vous a envoyé un message</br>
	<b>Objet: &nbsp&nbsp</b><?= $m['objet']?><?php if ($m['lu'] == 1) {  ?> </span><?php } ?></a> </br>
	*--------------------------------------------------------------*</br>
	<?php  } 

	 ?> 
	</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br>
</body>
</html>
<?php
}

require_once('includes/footer.php');

?>