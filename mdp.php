<?php
echo"
<html lang='fr'>
<head>
    <meta charset='utf-8'>
	<title>Changer de mot de passe</title>
	 <link rel='stylesheet' href='style2.css'>
</head>
<table align='center'> <tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font> </td> </tr> 
<body>";
include("menu.php");
echo"<table align='center'>
<form action='mdp.php' method=POST>
<tr><td><font size=5>Mot de passe actuel</td>
<td><input type=password name='mdp3' placeholder='Mot de passe'></td></tr>

<tr><td><font size=5>Nouveau mot de passe</td>
<td><input type=password name='mdp4' placeholder='Nouveau mot de passe'></td></tr>

<tr><td><font size=5>Confirmer le nouveau mdp</td> 
<td><input type=password name='mdp5' placeholder='Nouveau mot de passe'></td></tr>

<tr> <td>
<input type='submit' value=Valider>
<a href='Option.php'>Annuler</a>
</td> </tr>
</form>";

if ($_POST['mdp3'] =="" || $_POST['mdp4'] =="" || $_POST['mdp5'] ==""){
	echo"<table align='center'>
	<tr> <td >
	<font size=5 color=red>Veuillez remplir tout les champs! si ne souhaitez plus changer votre mot de passe</br>
	cliquez sur <a href='Option.php'>Annuler</a> ou utilisez la barre de menu déroulante
	</font>
	</td></tr> 
	</table>";
} else {
$mdp3 = $_POST['mdp3'];
$mdp4 = $_POST['mdp4'];
$mdp5 = $_POST['mdp5'];
if ($_POST['mdp4'] != $_POST['mdp5']){ // on vérifie si l'utilisateur a bien entré deux fois le même mot de passe
	
echo"<table align='center'><tr> <td><font size=5 color=red>Le nouveau mot de passe et le mot de passe de comfirmation
sont différents ! réessayez</td></tr>"	;
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
 $req = "SELECT mdp
        FROM inscrits
		WHERE login ='".$_SESSION['login1']"'";
		//requête sql^
$result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error());
$dat = mysql_fetch_assoc($result);

if($dat['mdp'] != $mdp3){ // on vérifie si l'utilisateur à bien donnée le bon mot de passe
echo "<table align='center'><tr> <td><font size=5 color=red>Mauvais mot de passe actuel! Veuillez réessayez</font></td></tr> </table>";
} else {
	
$req2 ="UPDATE inscrits
       SET mdp='$mdp4'
	   WHERE mdp = '$mdp3'";
	   //requête sql, on change le mot de passe de l'utilisateur
$result2 = mysql_query($req2) or die('Erreur SQL!'.$req2.'<br>'.mysql_error());
echo "<table align='center'><tr><td><font size=5 color='green'>Opération réussi, votre mot de passe à été modifier,
pour retourner à la page d'acceuil, cliquez <a href='accueil.php'>ici</a> ou pour continuer à modifier vos informations,</br>
cliquez <a href='Option.php'>ici</a>.";
 }
}
}
?>