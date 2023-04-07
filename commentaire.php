<?php
echo"
<table align='center'>
<tr><td align=center><H3 font>Commentaires sur cet articles</H4></tr></td>";

echo "<tr> <td align='center'> Postez un commentaire(il n'est pas obligatoire d'être inscrit)</td></tr>
<form action='".$_SERVER['PHP_SELF']."' method='POST'>
<table align='center'>
<tr> <td>Pseudonyme</td>
<td> <input type='text' name='nickname' placeholder='Pseudonyme'>
</td> </tr>
<tr> <td> Votre commentaire:</td> 
<td> <textarea rows='10' cols ='50' name='commentaire1'> </textarea> </td> </tr>
<tr><td> 
<input type='submit' name='envoi' value='Envoyer'>
<input type='reset' name='efface' value='Effacer'>
</td> </tr>";

if ($_POST['nickname']=="" || $_POST['commentaire1']==""){
	echo "<font color='red'>Vous avez cliquez sur \"Envoyer\" sans écrire de commentaire et/ou mettre un pseudonyme";

} else { 
echo "</table>";
$nickname = $_POST['nickname'];
$commentaire = addslashes($_POST['commentaire1']); // en cas de caractère spéciaux (",',?,!, ect)
$commentaire1 = nl2br($commentaire); // va permettre de couper le texte afin de passer à la ligne
$date = date("Y-m-d");
$nomp = addslashes($_SERVER['PHP_SELF']); // ceci va mettre des slash sur le nom de la page, et permettra de relier les commentaire à cette page

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



$req2 = "INSERT INTO commentaire(nompage, pseudonyme, contenu, date)
         VALUES ('$nomp' ,'$nickname', '$commentaire1', '$date')";
		 //requête sql, on insert les commentaire dans la base, avec comme nom de page la variable $nomp expliquer plus haut
$result2 = mysql_query($req2) or die('Erreur SQL!'.$req2.'<br>'.mysql_error());
}
include('coms.php');
?>
