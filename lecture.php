<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');

$bdd = new PDO('mysql:host=127.0.0.1;dbname=b-site-e-commerce','root','');

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
	if (isset($_GET['id']) and !empty($_GET['id'])) {
		$id_message=intval($_GET['id']);
	

$msg = $bdd->prepare('SELECT * FROM messages WHERE id = ? and id_destinataire = ?');
$msg->execute(array($_GET['id'],$_SESSION['id']));
$msg_nbr = $msg->rowCount();
$m = $msg->fetch();

	    $p_exp = $bdd->prepare('SELECT username FROM users WHERE id = ?');
       	$p_exp->execute(array($m['id_expediteur']));
       	$p_exp = $p_exp->fetch();
       	$p_exp = $p_exp['username'];

?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
          body{  background: url("style/messAZD.png") no-repeat; background-size: 100%;}
           div a { padding: 7px 30px; background-color: #d3dae6; color: #404f69;  border-radius: 5px; text-align: center;}
         div  a:hover{background-color:#404f69; color: #d3dae6; }
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
	<title>lecture de message  # <?=$id_message  ?> </title>
	<meta charset="utf-8">
</head>
<body> 
	<div  align="center">
    </br></br>  <a href="reception.php">Boîte de réception</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
    <a href="envoi.php?r=<?= $p_exp ?>&o=<?=urlencode($m['objet']) ?>">Répondre</a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  <a href="supprimer.php?id=<?= $m['id'] ?>">Supprimer</a></br>
     <h3>lecture de message  # <?=$id_message  ?> </h3> 
	<?php
	
	?>
	<?php if ($msg_nbr == 0) {	echo "Erreur...";}  else {?>
	<b> <?= $p_exp  ?> </b> vous a envoyé :  </br></br>
	<b>Objet:</b> <?= $m['objet']   ?>
	</br>
	<?= nl2br($m['message'])  ?> </br> 
	<?php } ?>
	</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br>
</body>
</html>
<?php

   $lu = $bdd->prepare('UPDATE messages SET lu = 1  WHERE id = ?');
   $lu->execute(array($m['id']));

} }

require_once('includes/footer.php');

?>