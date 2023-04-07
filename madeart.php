<?php
//cette page réunie tous les articles de la base donnée, et est inclus en bas de la page d'accueil

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
 
$req ="SELECT auteur, titre, contenu, data, id
        FROM articles";
$result= mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error()); // affiche les erreurs
echo"<table border=1 align='center'>";
while($ligne = mysql_fetch_assoc($result)){
$nomp = $ligne['id'] . '.php'; 
echo"
<tr><td><font size=5>".$ligne['auteur']."</td>
<td><font size=5>le ".$ligne['data']."</td>
<td><font size=5><a href='$nomp'>".$ligne['titre']."</a></td>
</tr>
";
}
echo"</table>";
?>
