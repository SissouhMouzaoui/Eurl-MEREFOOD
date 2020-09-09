<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');
require_once('includes/functions_panier.php');


$erreur = false;

$action = (isset($_POST['action'])?$_POST['action']:(isset($_GET['action'])?$_GET['action']:null));

if ($action!==null) {
	
	if (!in_array($action, array('ajout','suppression','refresh'))) 
		
		$erreur = true;

		$l = (isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
		$q = (isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
		$p = (isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));

		$l = preg_replace('#\v#', '', $l);

		$p = floatval($p);

		if (is_array($q)) {
			
			$QteArticle = array();
			$i = 0;
			foreach ($q as $contenu) {
				$QteArticle[$i++] = intval($contenu);
			}
		}else {
			$q = intval($q);
		}
	
}

if (!$erreur) {
	
	switch ($action) {

		case 'ajout':
			 ajouterArticle($l,$q,$p);
			break;

		case 'suppression':
			 supprimerArticle($l);
			break;

		case 'refresh':
			 
			 for ($i=0; $i <count($QteArticle) ; $i++) { 
			 	
			 	ModifierQTeProduit($_SESSION['panier']['libelleProduit'][$i], round($QteArticle[$i]));

			 }

			break;

		default:
			
			break;			
		
		
			
	}
}

?>
    <head>
        <style type="text/css">
          body{  background: url("style/panAZD.png") no-repeat; background-size: 100%;}
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
        <title>Panier</title>
        <meta charset="utf-8">
      </head>

<form  method="post" action="">

	<table width="400">

		<tr>
			<td colspan="4">Votre panier</td>
		</tr>

		<tr>
			<td>Libelle produit</td>
			<td>Prix unitaire</td>
			<td>Quantite</td>
			<td>TVA</td>
			<td>Action</td>
		</tr>
        </br>
		<?php

		if (isset($_GET['deletepanier']) && $_GET['deletepanier'] == true) {
			 
			 supprimerPanier();
		}

		 if (creationPanier()) {
          
          $nbProduits = count($_SESSION['panier']['libelleProduit']);

           if ($nbProduits <= 0) {
           	  echo '<br/><p style="font-size:20px; color:red;"> Oops, panier vide ! </p>';

           }else{
            
            
           	

           	for ($i=0; $i < $nbProduits; $i++) { 
           		
           		?>

           		<tr>
           		  <td><br/>	<?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
           		  <td><br/>	<?php echo $_SESSION['panier']['prixProduit'][$i]; ?></td>
           		  <td><br/><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>" size="5"/></td>
           		  <td><br/>	<?php echo $_SESSION['panier']['tva']."%"; ?></td>
           		  <td><br/><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]);  ?>">Supprimer</a>	</td>
           		</tr>
                   <?php  } ?>
           		<tr>
           			<td colspan="2">
           			
           		    <p>* Total :&nbsp <?php echo MontantGlobal(). "&nbsp DA ."; ?></p>
           			<p>* Pour choisir un autre produit cliquer  <a href="boutique.php">ici</a> .</p>	
           			<p>* Frais de port dépend de wilaya cliquer <a href="wilaya.php">ici</a> pour voir les frais de port . </p>
           			<p>* Pour faire votre commande vuieller vous <a href="connect.php">connecté</a> .</p>

           		    </td>
           		</tr>

           		<tr>
           			<td colspan="4">
           				<input type="submit" value="rafraichir"/>
           				<input type="hidden" name="action" value="refresh"/>
           				<a href="?deletepanier=true" style="color: #050f24">Supprimer le panier</a>
           			</td>
           		</tr>


           		<?php
           	

           }
       }

		?>
		

	</table>
	
</form>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<?php

require_once('includes/footer.php');

?>