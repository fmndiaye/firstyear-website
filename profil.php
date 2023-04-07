<?php
echo"
<html>
<head>
<title>Votre profil</title>
 <link rel='stylesheet' href='style2.css'>
</head>
<body>";
include('menu.php');
echo"
<table align='center'> <tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES 
</H1></font> </td> </tr></table>";

$login2 = $_SESSION['login1'];
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

$req="SELECT nom, prenom, login, naissance, mail
      FROM inscrits
	  WHERE login='$login2'"; // on récupère les informations de la personne connectez
	  
$result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error());
$dat = mysql_fetch_assoc($result);
	  
echo"
<table align='center' border=1>

<tr><td><font size=5>Login</td> <td><font size=5>".$dat['login']."</td>
<tr><td><font size=5>Nom</td> <td><font size=5>".$dat['nom']."</td></tr>
<tr><td><font size=5>Prenom</td> <td><font size=5>".$dat['prenom']."</td></tr>
<tr><td><font size=5>Date de naissance</td> <td><font size=5>".$dat['naissance']."</td></tr>
<tr><td><font size=5>Adresse e-mail</td> <td><font size=5>".$dat['mail']."</td></tr>
<tr><td><font size=5>Statut</td>";
if($login2 == 'Blim' || $login2 == 'Sidy75'){
	echo"<td><font size=5>Admin</td></tr>";
} else {
	echo"<td><font size=5>Membre</td></tr>";
}
echo"
</table>
<table align='center'><tr><td><font size=5><a href=option.php>Modifier ces informations</a></td></tr>";
?>
	  