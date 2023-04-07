<?php
echo"
<html lang='fr'>
<head>
    <meta charset='utf-8'>
	<title>Supprimer votre compte</title>
	 <link rel='stylesheet' href='style2.css'>
</head>
<table align='center'> <tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font> </td> </tr> 
<body>";
include("menu.php");
echo"
<table align='center'>
<tr><td align='center'>
<font size=5>Êtes-vous sûr de vouloir supprimer votre compte? cette opération est définitive et vous n'aurait</br>
plus accès à l'espace membre du site afin de créer des articles, mais vos articles seront toujours</br>
visible sur notre site, si vous voulez poursuivre l'opération, cochez à la case et cliquez sur </br>
'Supprimer', ou sur 'Annuler' si vous avez changez d'avis.
</td></tr>
</table>
<table align='center'>
<form action='delete.php' method='POST'>
<tr><td>
<input type='checkbox' name='suppr'><font size=5>Oui je veux supprimer mon compte
</td></tr>
</table>
<table align='center'>
<tr><td><font size=5>Mot de passe</td>
<td><input type='password' name='mdp'></td></tr>
<tr><td>
<input type='submit' value='Supprimer'>
<a href='Option.php'>Annuler</a>
</td></tr>
</form>
</table>";

if(!isset($_POST['suppr']) && $_POST['mdp'] == ""){
echo"<table align='center'>
<tr><td><font size=5 color='red'>
Vous n'avez ni cochez là case ni mis le bon mot de passe!
</td></tr>";

} else {
	
if($_POST['mdp'] ==""){
echo"<table align='center'>
<tr><td><font size=5 color='red'>
Vous n'avez pas mis de mot de passe!
</td></tr>";	

} else {
	
if(!isset($_POST['suppr'])){
echo"<table align='center'>
<tr><td><font size=5 color='red'>
Vous n'avez pas cochez la case!
</td></tr>";
} else {

$mdp = $_POST['mdp'];	
	
$server = "localhost"; // pour l'université : pams.script.univ-paris-diderot.fr	
$user = "root"; // nom d'utilisateur du server, comme le projet a été fait à la maison nous avons utilisés le logiciel wampserver afin d'avoir un serveur sur nos pc
$base = "io2"; // nom de la base
$connexion = mysql_pconnect($server, $user);

if(!$connexion){
	echo"Pas de connexion au serveur"; exit;
}

if(!mysql_select_db($base, $connexion)){
	echo "Pas d'accès à la base"; exit;
}

$req ="SELECT mdp
       FROM inscrits
	   WHERE login ='".$_SESSION['login1']."'";
	   //requête sql^
$result =  mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error());
 $dat = mysql_fetch_assoc($result);
 
 if($dat['mdp'] != $mdp){ //on test si le mot de passe entré est le bon mot de passe du compte
echo"<table align='center'>
<tr><td>
<font size =5 color='red'> Mauvais mot de passe!".$dat['mdp']."Veuillez réessayer
</td></tr>
</font>";
 
 } else {

$req2 ="DELETE FROM inscrits
        WHERE login ='".$_SESSION['login1']."'";
$result2 = mysql_query($req2) or die('Erreur SQL!'.$req2.'<br>'.mysql_error());
mysql_close();
session_destroy();

echo "<table align='center'>
<tr><td>
<font size=5 color='green'>
<Vous avez bien supprimer votre compte, nous somme triste de vous voir partir!</br>
pour retourner à la page d'accueil, cliquez <a href='accueil.php'>ici</a>, ou utilisez la</br>
la barre de menu
</font>
</td></tr>";
   }
}
}
}

?>