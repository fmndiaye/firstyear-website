 <?php
 $nomp = addslashes($_SERVER['PHP_SELF']);

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
		
 $req3 = "SELECT contenu, pseudonyme, date 
          FROM commentaire
		  WHERE nompage='$nomp'";
		  //pour récupérer les commentaire de la base de données, le $nomp va différiencer les commentaires, et les afficher sur leurs articles respectifs
$result3 = $result3 = mysql_query($req3) or die('Erreur SQL!'.$req3.'<br>'.mysql_error()); // permet d'afficher l'erreur, en cas d'erreur

 
while($ligne = mysql_fetch_assoc($result3)){
echo "
<table align='center' border=1>
<tr><td>
<font size=5>l'anonyme nommé(e) '".$ligne['pseudonyme']."'
a dit à ".$ligne['date']."</td></tr>
<tr><td>".$ligne['contenu']."</td></tr>
</table>
<br>";
  }
