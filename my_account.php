<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');
$bdd = new PDO('mysql:host=127.0.0.1;dbname=b-site-e-commerce','root','');

if (isset($_GET['id']) and $_GET['id']>0) {
  $getid = intval($_GET['id']);
  $requser = $bdd->prepare("SELECT * FROM users WHERE id= ?");
  $requser->execute(array($getid));
  $userinfo = $requser->fetch();


?>
<head>
        <style type="text/css">
          body{  background: url("style/comptAZD.png") no-repeat; background-size: 100%;}
          div a { padding: 7px 30px; background-color: #d3dae6; color: #404f69;  border-radius: 5px;}
          div a:hover{background-color:#404f69; color: #d3dae6; }
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
        <title>Mon compte</title>
        <meta charset="utf-8">
      </head> 
<div class="box" align="center"></br> 
<h1 style="color: #b3afaf; font-size: 50px">Mon compte</h1>
            <h1>Profil de <?php echo $userinfo['username']; ?></h1> 
            <h3>Username = <?php echo $userinfo['username']; ?></h3> 
            <h3>Email = <?php echo $userinfo['email']; ?></h3> </br>

<?php
if ( isset($_SESSION['id']) and $userinfo['id']==$_SESSION['id']) {
      ?>
 <a href="editionprofil.php">Editer mon profil</a> </br></br>
 <a href="reception.php">Mes messages</a> </br></br>
 <a href="disconnect.php" >Se déconnecter</a>
<?php

    }
?>

</div> </br></br></br></br></br></br></br></br>
<?php
}
require_once('includes/footer.php');

?>