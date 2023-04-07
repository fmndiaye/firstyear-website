<?php
echo"
<html lang='fr'>
<head>
    <meta charset='utf-8'>
	<title>Inscription à 15 Minutes</title>
	 <link rel='stylesheet' href='style2.css'>
</head>
<table align='center'> <tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font> </td> </tr> </table>
";
include('menu.php');
echo"
<br>
<br>
<br>
<br>
<br>
<br>
<body><H1 align='center'><font face='Comic Sans MS'>Inscription</H1> </font>
<form action='confirmation.php' method='POST'>
  <table align='center'>
    <tr> <td><font size=5> Nom:</td> </font>
    <td>
    <input type='text' name='nom'  placeholder='Nom'> </td> </tr>
    <tr> <td><font size=5>Prénom:</td> </font>
    <td>
    <input type='text' name='prenom'  placeholder='Prénom'> </td>
    </tr>
    <tr> <td><font size=5>Date de naissance</td> </font>
    <td>
	<input type='date' name='birth'> </td>
    <tr> <td><font size=5>Créé votre identifiant:</td></font>
    <td>
	<input type='text' name='login'  placeholder='Pseudonyme'> </td>
    </tr>
    <tr> <td>
	<font size=5> Adresse e-mail:</td></font>
    <td>
	<input type='email' name='email'  placeholder='Adresse courriel (e-mail)'> </td>
    </tr>
    <tr> <td>
	<font size=5>Créé votre Mot de passe:</td></font>
    <td>
    <input type='password' name='mdp'  placeholder='Mot de passe'> </td>
    </tr>
    <tr>
  <td>
<input type='submit' name='envoi' value='Envoyer'>Ou
<a href='accueil.php'>Annuler</a>
</td>
</tr>
</table>
</form>
</body>
</html>
";
?>