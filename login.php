<?php
echo"
<html lang='fr'>
<head>
    <meta charset='utf-8'>
	<title>Changer de pseudnoyme</title>
	 <link rel='stylesheet' href='style2.css'>
</head>
<table align='center'> <tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font> </td> </tr> 
<body>";
include("menu.php");
echo"<table align='center'>
<form action='login.php' method='POST'>
<tr><td><font size=5>Login actuel</td>
<td><input type='text' name='login4'></td></tr>

<tr><td><font size=5>Mot de passe</td>
<td><input type='password' name='mdp2'></td></tr>

<tr><td><font size=5>Nouveau login</td> 
<td><input type='text' name='login3'></td></tr>

<tr> <td>
<input type='submit' value=Valider>
<a href='Option.php'>Annuler</a>
</td> </tr>
</form>";

if ($_POST['login3'] =="" || $_POST['login4'] =="" || $_POST['mdp2'] ==""){
	echo"<table align='center'><tr> <td ><font size=5 color=red>Veuillez remplir tout les champs! si ne souhaitez plus changer votre login</br>
	cliquez sur <a href='Option.php'>Annuler</a> ou utilisez la barre de menu déroulante</font></td></tr> </table>";
} else {
$login4 = $_POST['login4'];
$login3 = $_POST['login3'];
$mdp2 = $_POST['mdp2'];

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
 $req = "SELECT mdp
        FROM inscrits
		WHERE login ='".$_SESSION['login']"'";
		//requête sql, on récupère le mot de passe de l'utilisateur pour le comparé au mot de passe du formulaire
$result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error()); // affiche les erreurs
$dat = mysql_fetch_assoc($result);

if($dat['mdp'] != $mdp2){
echo "<table align='center'><tr> <td><font size=5 color=red>Mauvais mot de passe! Veuillez réessayez</font></td></tr> </table>";
} else {
	
$req2 ="UPDATE inscrits
       SET login='$login3'
	   WHERE mdp = '$mdp2'";
	   //requête sql, on modifie le login
$result2 = mysql_query($req2) or die('Erreur SQL!'.$req2.'<br>'.mysql_error()); // affiche les erreurs
echo "<table align='center><tr><td><font size=5 color='green'>Opération réussi, votre nouveau login est maintenant '$login3',
pour retourner à la page d'acceuil, cliquez <a href='accueil.php'>ici</a>,ou pour continuer à modifier vos informations,</br>
cliquez <a href='Option.php'>ici</a>.(Il faudra vous déconnectez et vous reconnectez afin d'actualiser votre login sur la barre de menu";
 }
}
?>
