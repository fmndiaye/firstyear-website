<table align="center"> <tr> <td align="center"> <H1><font face="comic sans MS"> 15 MINUTES </H1> </font> </td> </tr> </table>
<?php
echo"<link rel='stylesheet' href='style1.css'>";
include("menu.php");
if ($_POST['nom'] =="" || $_POST['prenom'] =="" || $_POST['birth'] =="" || $_POST['login']=="" || $_POST['email']=="" || $_POST['mdp']==""){
echo "<html>
<head>
<title>Erreur!</title>
<link rel='stylesheet' href='style2.css'>
</head>
<body>
<table align='center'>
 <tr> <td align='center'>
 <font color='red' size=5>Veuillez remplir tout les champs afin de valider
<a href='inscription.php'>l'inscription!</a>
</font> 
</td> </tr> 
</table>
";	
} else {
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$birth = $_POST['birth'];
$login = $_POST['login'];
$email = mysql_real_escape_string($_POST['email']);
$mdp = $_POST['mdp'];

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
 $req1="SELECT login
        FROM inscrits
		WHERE login = '$login'";
		//requête sql^
$result1 = mysql_query($req1) or die('Erreur SQL!'.$req1.'<br>'.mysql_error()); //la suite apres or die sert seulement à afficher nos erreurs
if(mysql_num_rows($result1) == 1){ // on vérifie si le speudonyme est déjà prit
echo "<table align='center'>
<tr><td align='center'>
<font size=5 color='red'>Ce pseudonyme est déjà prit! veuillez en choisir un 
<a href='inscription.php'>autre</a>
</font> 
</td> </tr>
</table>";
} else {
 $req = "INSERT INTO inscrits(nom, prenom, login, naissance, mail, mdp)
         VALUES ('$nom', '$prenom', '$login', '$birth', '$email', '$mdp')";
		 //requète sql, on insert les données dans la base de donnée, l'utilisateur peu maintenant ce connecter
$result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error()); // affiche les erreurs

mysql_close();
echo "
<html>
<head>
<title>Confirmation</title>
<link rel='stylesheet' href='style2.css'>
</head>
<body background=S.jpg>
<table align='center'>
<tr>
<td align='left'>
<font color='green' size=5>Votre inscription à été prise en compte !</br>
pour vous connecter: cliquez <a href=connexion.php>ici</td></br>";	
  }
}
?>