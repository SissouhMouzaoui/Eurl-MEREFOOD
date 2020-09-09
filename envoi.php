<?php
# session_start();

require_once('includes/header.php');
require_once('includes/sidebar.php');

$bdd = new PDO('mysql:host=127.0.0.1;dbname=b-site-e-commerce','root','');

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
if (isset($_POST['envoi_message'])) {
	if (isset($_POST['destinataire'],$_POST['message'],$_POST['objet']) and !empty($_POST['destinataire']) and !empty($_POST['message']) and !empty($_POST['objet'])) {
       $destinataire = htmlspecialchars($_POST['destinataire']);
       $message = htmlspecialchars($_POST['message']);
       $objet = htmlspecialchars($_POST['objet']);

       $id_destinataire = $bdd->prepare(' SELECT id FROM users WHERE username = ?');
       $id_destinataire->execute(array($destinataire));
       $dest_exist = $id_destinataire->rowCount();

       if ($dest_exist == 1) {
       	
       $id_destinataire = $id_destinataire->fetch();
       $id_destinataire = $id_destinataire['id'];

       $ins = $bdd->prepare('INSERT INTO messages(id_expediteur,id_destinataire,message,objet) VALUES (?,?,?,?)');
       $ins->execute(array($_SESSION['id'],$id_destinataire,$message,$objet));

       $error = "Votre message a bien été envoyé  !" ;
       }else{
       	$error = "Cet utilisateur n'existe pas...";
       }
       
		
	}else {  
		$error = "Veuillez compléter tous les champs" ;
		 }
}
$destinataires = $bdd->query("SELECT username FROM users ORDER BY username");

if (isset($_GET['r'])  and !empty($_GET['r'])) {
	$r = htmlspecialchars($_GET['r']);
}

if (isset($_GET['o'])  and !empty($_GET['o'])) {
	$o = urlencode($_GET['o']);
	$o = htmlspecialchars($_GET['o']);
	if (substr($o, 0,3)) {
		$o = "RE: ".$o;
	}
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
          body{  background: url("style/messAZD.png") no-repeat; background-size: 100%;}
           form  a { padding: 7px 30px; background-color: #d3dae6; color: #404f69;  border-radius: 5px; text-align: center;}
         form  a:hover{background-color:#404f69; color: #d3dae6; }
        </style>
        <link rel="icon" type="image/x-icon" href="style/1111.png">
	<title>Envoi de message</title>
	<meta charset="utf-8">
</head>
<body>
      
     

 <form method="POST" style="text-align: center;">
 	</br></br>
 	<h3>Pour faire votre commande veuillez copier' Azedine MOUZAOUI 'dans le destinataire et envoyez votre message</h3>

    
 	<label>Destinataire :</label>
 	 <!--<select  name="destinataire" >
 		<?php while ($d = $destinataires->fetch()) {  ?>
 			<option> <?= $d['username'] ?></option>
 	    <?php } ?>
 		</select> -->
 		
 	<input type="text" name="destinataire" <?php if (isset($r)) { echo 'value="'.$r.'"' ;}  ?> >	
    </br></br>
    <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Objet :</label>
 	<input type="text" name="objet"  <?php if (isset($o)) { echo 'value="'.$o.'"' ;}  ?>/>	</br>	</br>
    <textarea placeholder="votre message" name="message" style="height: 100px; width: 350px;"></textarea>
    </br></br>
    <input type="submit" value="Envoyer" name="envoi_message"/>
    </br></br>
    <?php if (isset($error)) { echo '<span style="color:red">'.$error.'</span>' ; } ?>
</br>  </br> <a href="reception.php" style="text-decoration: none;"> Boîte de réception</a>
  </form>     
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
</body>
</html>

<?php
}

require_once('includes/footer.php');

?>