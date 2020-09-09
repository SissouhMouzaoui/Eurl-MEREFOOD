<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');

$bdd = new PDO('mysql:host=127.0.0.1;dbname=b-site-e-commerce','root','');

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
	if (isset($_GET['id']) and !empty($_GET['id'])) {
		$id_message=intval($_GET['id']);
	

$msg = $bdd->prepare('DELETE FROM messages WHERE id = ? and id_destinataire = ?');
$msg->execute(array($_GET['id'],$_SESSION['id']));

header('Location:reception.php');	    
} 
 }

?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
          body{  background: url("style/envoi mess.png") no-repeat; background-size: 100%;}
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
	<title>supprimer un message  </title>
	<meta charset="utf-8">
</head>

</html>
<?php
require_once('includes/footer.php');

?>