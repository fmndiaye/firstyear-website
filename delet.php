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
 
 $req="SELECT nom, prenom, login, id
       FROM inscrits";
 $result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error());
echo"<table align='center'><font size='5'>
Si vous êtes sur de vouloir supprimer un compte, cliquez sur supprimer, à gauche du compte concerné</br>
<font color='red' size=5>ATTENTION!! une fois cliquez sur supprimer, le compte sera supprimer directement!
</table>";

 echo"<table align='center' border=1>";
 
while($dat = mysql_fetch_assoc($result)){
	echo"<form action='deleteuh.php' method='POST'>
     <tr><td><font size =5>\"".$dat['nom']."\" \"".$dat['prenom']."\"</td>
	 <td><font size=5>Pseudonyme:\"".$dat['login']."\"</td>";
	 if($dat['login'] == 'Blim' || $dat['login'] == 'Sidy75'){
	 echo"<td>Compte admin</td></tr>";
	 
	 } else {
		 
     echo"<td><input type='submit' value='Supprimer'></td></tr>";
	 }
	 echo"<input type='hidden' name='id' value='".$dat['id']."'>";
  }
       
} else {
	"<table align='center'>
	<tr><td>
	<font size=5 color=red>Vous n'êtes pas administrateur ".$_SESSION['login1']." !!! Pour retourner à la page d'accueil,</br>
	cliquez <a href='accueil.php'>ici</a>
	</td></tr>
	</table>";	
   }   

}
?>