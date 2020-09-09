<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');
$bdd = new PDO('mysql:host=127.0.0.1;dbname=b-site-e-commerce','root','');

if (isset($_SESSION['id'])) {
 $requser = $bdd->prepare("SELECT * FROM users WHERE id= ? ");
 $requser->execute(array($_SESSION['id']));
 $user = $requser->fetch();

 if (isset($_POST['newpseudo']) and !empty($_POST['newpseudo']) and $_POST['newpseudo'] != $user['username']) {
   $newpseudo = htmlspecialchars($_POST['newpseudo']);
   $insertpseudo = $bdd->prepare("UPDATE users SET username = ? WHERE id =?");
   $insertpseudo->execute(array($newpseudo,$_SESSION['id']));
  
 }

 if (isset($_POST['newemail']) and !empty($_POST['newemail']) and $_POST['newemail'] != $user['email']) {
   $newemail = htmlspecialchars($_POST['newemail']);
   $insertemail = $bdd->prepare("UPDATE users SET email = ? WHERE id =?");
   $insertemail->execute(array($newemail,$_SESSION['id']));
   header('Location:my_account.php?id='.$_SESSION['id']);
 }

 if(isset($_POST['newmdp1'])and !empty($_POST['newmdp1'])and isset($_POST['newmdp2'])and !empty($_POST['newmdp2'])){
   $mdp1 = sha1($_POST['newmdp1']);
   $mdp2 = sha1($_POST['newmdp2']);
   
   if ($mdp1 == $mdp2) {
     $insertmdp = $bdd->prepare("UPDATE users SET password = ? WHERE id=?");
     $insertmdp->execute(array($mdp1, $_SESSION['id']));
     header('Location:my_account.php?id='.$_SESSION['id']);
   } else { $msg = "Vos deux mdp ne correspondent pas !" ;}
   
 }
 if (isset($_POST['newpseudo']) and $_POST['newpseudo'] == $user['username']) {
    header('Location:my_account.php?id='.$_SESSION['id']);
 }

?>
<head>
        <style type="text/css">
          body{  background: url("style/comptAZD.png") no-repeat; background-size: 100%;}
           div a{ padding: 7px 30px; background-color: #d3dae6; color: #404f69;  border-radius: 5px; text-align: center;}
         div a:hover{background-color:#404f69; color: #d3dae6; }
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
        <title>Mon compte</title>
        <meta charset="utf-8">
      </head> 
<div class="box" align="center"></br>
<a href="my_account.php?id=<?= $_SESSION['id'] ?>">Profil</a>
<h2 style="color: #154013; font-size: 30px">Edition de mon profil</h2>
   <form method="POST" action="">
     <label>Pseudo :</label></br>
     <input type="text" name="newpseudo" placeholder="Pseudo" value=" <?php echo $user['username']; ?> " /></br></br>
     <label>Email :</label></br>
     <input type="email" name="newemail" placeholder="Mail" value=" <?php echo $user['email']; ?> "  /></br></br>
     <label>Mot de passe :</label></br>
     <input type="password" name="newmdp1" placeholder="Mot de passe"   /></br></br>
     <label>Confirmation mot de passe :</label></br>
     <input type="password" name="newmdp2" placeholder="Confermation du mot de passe" /></br></br>
     <input type="submit" value="mettre à jour !"/>
   </form>
   <?php if (isset($msg)) {
     echo '<font color="red">'. $msg ."</font>";
   }  ?>
      </div></br></br></br>
<?php
}else{ header("Location:connect.php");}
require_once('includes/footer.php');

?>

