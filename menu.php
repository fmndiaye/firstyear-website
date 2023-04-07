<?php
include('footer.html'); //mettre le footer ici permet de le mettre sur toute les pages, vu que le menu est déjà inclus partout
session_start(); // cette session sera active seulement lors d'une connexion, il est mit ici car cette page sera sur toute les pages
echo"
<html lang='fr'>
<head>
    <meta charset='utf-8'>
	<link rel='stylesheet' href='menu.css' type='text/css'></link>
<style type='text/css'>
      #bg{width: 960px; height: 600px; overflow:hidden; }
</style>
</head>
<body>
   <table align=center>
   <td>
   <ul id='menu'>
      <li><a href='accueil.php'>Accueil</a></li>";
	  if(!isset($_SESSION['connecte'])){
	  echo"
      <li>
          <a href='#'>Login et Inscription</a>
             <ul>
             <li><a href='Inscription.php'>S'inscrire</a></li>
             <li><a href='Connexion.php'>Se connecter</a></li>
             </ul>
      </li>"; } else {
	  echo"
	   <li>
	       <a href='#'>".$_SESSION['login1']."</a>
		      <ul>
			  <li><a href='profil.php'>Mon profil</a></li>
			  <li><a href='Option.php'>Option</a></li>
			  <li><a href='deconnexion.php'>Se déconnecté</a></li>";
			  	   if($_SESSION['login1']=='Blim' || $_SESSION['login1']=='Sidy75'){
	  echo"   <li><a href='delet.php'>Supprimer des comptes</a></li>";
// il arrive parfois, que session login affiche '1' au lieu de votre pseudo, 
// nous ne trouvons pas de solution à ce problème..., mais cela arrive seulement quelque fois
		}
        echo"</ul>
      </li>";		  
	  }	
echo"	  
	  
	  <li>
	      <a href='#'>Espace Membres</a>
		     <ul>
             <li><a href='myarticle.php'>Mes articles</a></li>
             <li><a href='makeart.php'>Crée un article</a></li>";
			   if(isset($_SESSION['connecte'])){
             if($_SESSION['login1']=='Blim' || $_SESSION['login1']=='Sidy75'){
			 echo"
			 <li><a href='supprime.php'>Supprimer des articles de membres</a></li>";
			     }
			   }
			 echo"
			 <li><a href='suppr.php'>Supprimer mes articles</a></li>";
			
echo"				 
			 </ul>
	  </li>
		
        <li>
		    <a href='#'>À propos</a>
			   <ul>
               <li><a href='listaut.php'>Liste des auteurs</a></li>
                </ul>
	    </li>
   </ul>
   </td>
  </tr>
  <td align=center> <img src='15minutes.jpg'> </td>
</table>
</body>
</html>
";
?>