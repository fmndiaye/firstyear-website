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

$id = $_POST['id'];
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
 
 $req="DELETE FROM inscrits
       WHERE id = '$id'";
 $result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error());
 
 echo"<font size=5 color=green>Ce compte à bien été supprimé! pour retourner à la page d'accueil,</br>
      cliquez <a href='accueil.php'>ici</a>";
}	  
?>