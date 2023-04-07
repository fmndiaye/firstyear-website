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
 
 $req ="SELECT nom, prenom, login
        FROM inscrits";
 $result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error()); // permet d'afficher l'erreur, en cas d'erreur
 
 echo"<table align='center' border=1>";
 while($dat = mysql_fetch_assoc($result)){
	 echo"<tr><td>
	 <font size =5>\"".$dat['nom']."\" \"".$dat['prenom']."\"</td>
	 <td><font size=5>Pseudonyme:\"".$dat['login']."\"</td></tr>";
 }
 echo "</table>";
 
?>

 