<?php
echo"
<html lang='fr'>
<head>
    <meta charset='utf-8'>
	<title>Changer d'adresse e-mail</title>
	 <link rel='stylesheet' href='style2.css'>
</head>
<table align='center'> <tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font> </td> </tr> 
<body>";
include("menu.php");
echo"<table align='center'>
<form action='email.php' method='POST'>
<tr><td><font size=5>Adresse e-mail actuel</td>
<td><input type='email' name='email1' placeholder='Adresse e-mail'></td></tr>

<tr><td><font size=5>Nouvelle adresse e-mail</td>
<td><input type='email' name='email2' placeholder='Nouvelle adresse e-mail'></td></tr>

<tr><td><font size=5>Confirmer la nouvelle adresse</td> 
<td><input type='email' name='email3' placeholder='Nouvelle adresse e-mail'></td></tr>

<tr><td><font size=5>Mot de passe</td>
<td><input type='password' name='mdp5' placeholder='Mot de passe'></td></tr>

<tr> <td>
<input type='submit' value=Valider>
<a href='Option.php'>Annuler</a>
</td> </tr>
</form>";

if ($_POST['email1'] =="" || $_POST['email2'] =="" || $_POST['email3'] =="" || $_POST['mdp5']==""){
	echo"<table align='center'><tr> <td ><font size=5 color=red>Veuillez remplir tout les champs! si ne souhaitez plus changer votre adresse e-mail</br>
	cliquez sur <a href='Option.php'>Annuler</a> ou utilisez la barre de menu déroulante</font></td></tr> </table>";
} else {
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$email3 = $_POST['email3'];
$mdp5 = $_POST['mdp5'];

if ($_POST['email2'] != $_POST['email3']){
	echo"<table align='center'><tr> <td><font size=5 color=red>La nouvelle adresse e-mail et l'adresse e-mail de comfirmation
sont différentes ! réessayez</td></tr></font>"	;
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
 $req1 = "SELECT mail
          FROM inscrits
		  WHERE login ='".$_SESSION['login1']."'";
$result1 = mysql_query($req1) or die('Erreur SQL!'.$req1.'<br>'.mysql_error()); // affiche les erreurs
$dat1 = mysql_fetch_assoc($result1);	  
 if($dat1['mail'] != $email1){
	 echo"<table align='center'><tr><td align='center'> <font size=5 color='red'>Mauvaise adresse e-mail actuelle! Veuillez réessayez</font></td></tr></table>";
 } else {
 $req2 = "SELECT mdp
        FROM inscrits
		WHERE mail = '$email1'";
		//requête sql, on vérifie le mot de passe
$result2 = mysql_query($req2) or die('Erreur SQL!'.$req2.'<br>'.mysql_error()); //affiche les erreurs
$dat2 = mysql_fetch_assoc($result2);

if($dat2['mdp'] != $mdp5){
echo "<table align='center'><tr> <td><font size=5 color=red>Mauvais mot de passe! Veuillez réessayez</font></td></tr> </table>";
} else {
	
$req3 ="UPDATE inscrits
       SET mail='$email2'
	   WHERE mdp = '$mdp5'";
	   //requête sql, on change l'email
$result3 = mysql_query($req3) or die('Erreur SQL!'.$req3.'<br>'.mysql_error()); // affiche les erreurs
echo "<table align='center'><tr><td><font size=5 color='green'>Opération réussi, votre adresse e-mail à été modifier,
pour retourner à la page d'acceuil, cliquez <a href='accueil.php'>ici</a> ou pour continuer à modifier vos informations,</br>
cliquez <a href='Option.php'>ici</a>.";
           }
       }
   }
}

?>