<?php
echo"
<html>
<head>
<title>Vérification</title>
<meta charset = utf-8>
<link rel='stylesheet' href='style2.css'>
</head>
<body>
";
if($_POST['login1'] =="" || $_POST['password1']==""){
include('menu.php');	
echo "<table align='center'><tr><td><font size=5 color='red'>Veuillez remplir les deux a champs afin de vous 
<a href='connexion.php'>connectez!</a></td></tr>";
} else {
$login1 = mysql_real_escape_string($_POST['login1']); // protège des injection sql
$password1 = mysql_real_escape_string($_POST['password1']);
	
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

$req = "SELECT mdp
        FROM inscrits
		WHERE login ='$login1'";
		//requête sql on récupère le mot de passe du pseudo donnée
$result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error());
  $data = mysql_fetch_assoc($result);

$req2 = "SELECT login
         FROM inscrits
		 WHERE mdp ='$password1'";
		//requête sql on test le mot de passe
$result2 = mysql_query($req2) or die('Erreur SQL!'.$req2.'<br>'.mysql_error());
  $data2 = mysql_fetch_assoc($result2);  
  
if($data['mdp'] != $password1 ||$data2['login'] =! $login1){
include('menu.php');
echo "<table align='center'>
<tr><td>
<font size =5 color='red'>Mauvais /login/mot de passe, essayez 
<a href='connexion.php'>encore</a>. Pas encore inscrit(e) ? Cliquez <a href='inscription.php'>ici</a></td></tr>";
exit;
	
}else {
include('menu.php');	
	$_SESSION['login1'] = $login1;
	$_SESSION['mdp1'] = $password1;
	$_SESSION['connecte'] = 'oui';

echo "<table align='center'>
<tr><td> 
<font size=5 color=green>Vous etes bien connecté, 
cliquez <a href='accueil.php'>ici</a> pour retourner à la page d'accueil, 
où utilisez le menu ci-dessus 
</font> 
</td> </tr> 
</table> ";

    }

}
?>