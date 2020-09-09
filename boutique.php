<?php



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

require_once('includes/header.php');
require_once('includes/sidebar.php');

 if (isset($_GET['show'])) {
 	
    $product = $_GET['show'];
 	$select = $db->prepare("SELECT * FROM products WHERE title='$product' ");
    $select->execute();

    $s = $select->fetch(PDO::FETCH_OBJ);

    $description = $s->description;
    $description_finale=wordwrap($description,120,'<br/>',true);

    ?>
     <head>
        <style type="text/css">
          body{  background: url("style/boutiAZD.png") no-repeat; background-size: 100%;}
          div  a{padding: 8px 20px;background-color: #1909ed;color: white;border-radius: 10px;}
          div a:hover{ background-color: #e1e3f7;color: #1909ed ; }
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
        <title>Produit</title>
        <meta charset="utf-8">
      </head>

       <br/> <div style="text-align:center; ">
        <img src="admin/imgs/<?php echo $s->title; ?>.jpg"/ style="border-radius: 50%;width: 300px;height: 300px" >	
        <h1> <?php echo $s->title; ?> </h1>
        <h5> <?php echo $description_finale; ?> </h5>
        <h5>Stock :<?php echo $s->stock; ?> </h5>
        <?php if ($s->stock!=0){?><a href="panier.php?action=ajout&amp;l=<?php echo $s->title; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>">Ajouter au panier </a> <br/><br/> <?php }else{echo '<h5 style="color:red;">Stock épuisé !</h5> ';} ?>
        </div> 
    <?php

 }else {

    if (isset($_GET['category'])) {
	
	$category=$_GET['category'];
	$select = $db->prepare("SELECT * FROM products WHERE category='$category' ");
    $select->execute();

    

    while ($s=$select->fetch(PDO::FETCH_OBJ)) {

        $length=50;

    $description=$s->description;

    $new_description=substr($description,0,$length)."...";

    $description_finale=wordwrap($new_description,25,'<br/>',false);

      ?>
     <head>
       <style type="text/css">body{  background: url("style/bouAZD.png") no-repeat; background-size: 100%;}
       div table th.kik a{padding: 8px 20px;background-color: #1909ed;color: white;border-radius: 10px;}
       div table th.kik a:hover{ background-color: #e1e3f7;color: #1909ed ; }
       </style>
        <link rel="icon" type="image/x-icon" href="style/1111.png">
      <title>Produits</title><meta charset="utf-8"></head>
       </br> <hr/> <div style="text-align: center;">
          <table   border="1" cellpadding="10" cellspacing="1" width="950px">
         <th width="20%"><a href="?show=<?php echo $s->title; ?>"> <img src="admin/imgs/<?php echo $s->title; ?>.jpg" style="width: 100px; height: 100px"/></a></th>
        <th width="15%"><a href="?show=<?php echo $s->title; ?>"><h3> <?php echo $s->title ;  ?> </h3></a> </th>
        <th><h5  style="color:#8d8d8f;" > <?php echo $description_finale ;  ?> </h5> </th> 
        <th width="10%"><h4> <?php echo $s->price ;  ?> DA </h4> </th>
        <th width="10%"><h5>Stock :<?php echo $s->stock; ?> </h5></th>
        <th class="kik"   width="20%" ><?php if ($s->stock!=0){?><a href="panier.php?action=ajout&amp;l=<?php echo $s->title; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>" >Ajouter au panier </a> <br/><br/> <?php }else{echo '<h5 style="color:red;">Stock épuisé !</h5> ';} ?> 
        </table> 
        </div>
      <?php
    }


}else {
  ?>

  <head>
        <style type="text/css">
          body{  background: url("style/boutAZD.png") no-repeat; background-size: 100%;}
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
        <title>Boutique</title>
        <meta charset="utf-8">
      </head></br>
<h1 style="margin-left: 230px; color:#c8cbcf; font-size: 40px">Catégories :</h1>
  <?php

 $select = $db->query("SELECT * FROM category");

 while ($s = $select->fetch(PDO::FETCH_OBJ)) {
 	?>
     
     <a href="?category=<?php echo $s->name; ?>"><h3 style="color:black;margin-left: 250px" ><?php echo $s->name  ?> <br/> </h3></a> 
 	<?php
 }
  ?>
     
     <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>  <br/> <br/> <br/> <br/>   <br/> <br/>  <br/> 
 	<?php  
 }

}
require_once('includes/footer.php');

?>