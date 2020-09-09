<?php
require_once('includes/header.php');
require_once('includes/sidebar.php');

   try
      	{
      	$db = new PDO('mysql:host=localhost;dbname=b-site-e-commerce', 'root','');
      	$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);	
      	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
      	}
      	catch(Exception $e){
      		echo 'Une erreur est survenue';
      		die();
      	}

$select = $db->prepare("SELECT * FROM wilaya");
    $select->execute();

?> 

 <head>
        <style type="text/css">
          body{  background: url("style/wilaAZD.png") no-repeat; background-size: 100%;}
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
        <title>Wilaya</title>
        <meta charset="utf-8">
      </head>

<h1 style="margin-left: 230px; color:#020526; font-size: 50px">Wilaya :</h1>
<?php

 $select = $db->query("SELECT * FROM wilaya");

 while ($s = $select->fetch(PDO::FETCH_OBJ)) {
 	?>
     
     <h3 style="color: black;margin-left: 250px" ><?php echo $s->name  ?> : &nbsp&nbsp&nbsp&nbsp<?php echo $s->price ."&nbsp &nbsp DA"  ?> <br/> </h3> 


 	<?php
 }
 ?> <h3 style="margin-left: 150px;color: #132919">* Pour faire votre commande vuieller vous <a href="connect.php">connecté</a> .</h3>  </br></br></br></br></br></br></br><?php
  
require_once('includes/footer.php');

  ?>