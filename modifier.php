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
 
$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
$art = htmlspecialchars($_POST['article2'], ENT_QUOTES);
$art = nl2br($art);
$id = $_POST['id'];

$req ="UPDATE articles
        SET contenu='$art'
	    WHERE id='$id'";
		// on modifie l'article dans la base de donnée
$result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error()); // permet d'afficher l'erreur, en cas d'erreur
$dat = mysql_fetch_assoc($result);

$req2 ="UPDATE articles
        SET titre='$title'
		WHERE id='$id'"; // nous n'avons pas fait cela en une seule requête, car lorsque l'on le fait en une fois, le titre devient '0' 
$result2 = mysql_query($req2) or die('Erreur SQL!'.$req.'<br>'.mysql_error()); 
	
$nomp = $id . '.php';

echo"
<table align='center'>
<form action='$nomp' method='POST'>
<tr><td> 
<font size=5 color='green'>
Votre article à été modifié ! pour le consulter aller des 'Mes articles'</br> 
depuis la barre de menu où cliquez sur 'Valider'
</td></tr>
<tr><td>
<input type='submit' value='Valider'> 
</font>
</form>
</td></tr>
</table>";

unlink($nomp); // on supprime l'ancien fichier de l'article pour en crée un nouveau, avec le nouveau contenu
$fp = fopen("$nomp", 'w'); // cette fonction nous permet d'écrir dans un fichier, comme on le modif, on le vide d'abord
fwrite($fp, "<?php
echo\"
<html lang='fr'>
   <head>
      <meta charset='utf-8'>
	  <title>15 Minutes, information irrégulière</title>
	  <link rel='stylesheet' href='style2.css'>
   </head>
      <body background='gris.jpg'> 
<table align='center' bgcolor='white'>
<tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font>\"; 
include('menu.php');
echo\"<table align='center' bgcolor='white'>
<tr><td align='center'>
<h2>$title<h2>
</td></tr>
</br>
</br>
<tr><td align='center'>
<font size=4><p>$art</p></font>
</td></tr>
</table>
<table align='left'>
<tr><td align='left'><font size=4>auteur: ".$_SESSION['login1']."</td></tr>
<tr><td>\";
include('commentaire.php');
echo\"</tr></td>\";
?>");
fclose($fp);
  }


?>    