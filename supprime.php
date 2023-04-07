<?php
echo"
<html lang='fr'>
   <head>
      <meta charset='utf-8'>
	  <title>15 Minutes, information irrégulière</title>
	  <link rel='stylesheet' href='style2.css'>
   </head>
     <body> 
<table align='center'>
<tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font>";

include('menu.php');
if(!isset($_SESSION['connecte'])){	
	  echo"<table align='center'>
	  <tr><td>
	  <font size=5 color='red'> Veuillez vous connectez(ou vous inscrir <a href='inscription.php'>ici</a>)
	  afin d'accèder à l'espace membres !
	  </font>
	  </td></tr>
	  </table>"; 
} else {
if($_SESSION['login1']='Blim' || $_SESSION['login1']='Sidy75'){
	
$server = "localhost"; // pour l'université : pams.script.univ-paris-diderot.fr	
$user = "root"; // nom d'utilisateur du server, comme le projet a été fait à la maison nous avons utilisés le logiciel wampserver afin d'avoir un serveur sur nos pc
$base = "io2"; // nom de la base
$connexion = mysql_pconnect($server, $user);

 if(!$connexion){
  echo "Pas de connexion au serveur"; exit;	 
 }
 
 if(!mysql_select_db($base, $connexion)){
  echo "Pas d'acces a la base"; exit;
 }
 
 $req ="SELECT titre, id
        FROM articles";
		 
 $result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error()); // permet d'afficher l'erreur, en cas d'erreur

 echo"<table align='center'><font size='5'>
Si vous êtes sur de vouloir supprimer un article, cliquez sur supprimer, à gauche de l'article concerné</br>
<font color='red' size=5>ATTENTION!! une fois cliquez sur supprimer, l'article sera supprimer directement!";

 while ($ligne = mysql_fetch_assoc($result)){
$lien = $ligne['id'] . '.php';
echo"
<form action='supprimer.php' method='POST'>
<table align='center'>
<tr>
<td>
<a href='$lien'>".$ligne['titre']."</a>
<input type='hidden' name='article' value='".$ligne['titre']."'>
</td>
<td>
<input type='submit' value='Supprimer'>
</td></tr>";
 }
} else { 
echo"<table align='center'>
	<tr><td>
	<font size=5 color=red>Vous n'êtes pas administrateur ".$_SESSION['login1']." !!! Pour retourner à la page d'accueil,</br>
	cliquez <a href='accueil.php'>ici</a>
	</td></tr>
	</table>";
 }
}
?>
