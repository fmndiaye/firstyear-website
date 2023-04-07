<?php
echo"
<html lang='fr'>
   <head>
      <meta charset='utf-8'>
	  <title>15 Minutes, information irrégulière</title>
	   <link rel='stylesheet' href='style2.css'>
   </head>
     <body> 
<table align='center'>
<tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font>";
include('menu.php');
include('footer.html');

if(!isset($_SESSION['connecte'])){	
	  echo"<table align='center'>
	  <tr><td>
	  <font size=5 color='red'> Veuillez vous connectez(ou vous inscrir <a href='inscription.php'>ici</a>)
	  afin d'accèder à l'espace membres !
	  </font>
	  </td></tr>
	  </table>"; 
} else {

echo"
<form action='makeart.php' method='POST'>
<table align='center'>
<tr><td>
<font size=5>Titre de l'article</td>
<td>
<input type='text' name='title' placeholder='titre'>
</td></tr>
</table>
<table align='center'>
<tr><td align='center'>
<font size=5> écrivez votre article:
</td></tr>
<tr><td>
<textarea wrap='physical' rows='30' cols ='90' name='article1'> </textarea> 
</td> </tr>
<tr><td align='center'>
<input type='submit' value='Envoyer'>
<input type='reset' value ='Effacer'>
</td></tr>
</form>";

if($_POST['title'] =="" || $_POST['article1'] ==""){
echo"<table align='center'>
<tr><td>
<font size=5 color ='red'>Veuillez remplir tout les champs afin d'envoyer votre articles !</font>
</td></tr>
</table>";

} else {

$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
$article = htmlspecialchars($_POST['article1'], ENT_QUOTES); // en cas de caractère spéciaux (",?,!, ect)
$article1 = nl2br($article);
$date = date("Y-m-d");

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


$req ="INSERT INTO articles(auteur, titre, contenu, data)
       VALUES ('".$_SESSION['login1']."', '$title', '$article1', '$date')"; // on entre l'article dans la base
$result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error());

$req2="SELECT id
       FROM articles
	   WHERE titre = '$title'";
$result2 = mysql_query($req2) or die('Erreur SQL!'.$req2.'<br>'.mysql_error());
$dat = mysql_fetch_assoc($result2);

$nomp = $dat['id'] . '.php';


echo"<table align='center'>
<form action='$nomp' method='POST'>
<tr><td> 
<font size=5 color='green'>
Votre article à été crée !pour le consulter cliquez sur 'Valider'
</td></tr>
<tr><td>
<input type='submit' value='Valider'> 
</font>
</td></tr>
</table>";

$fp = fopen("$nomp", 'w'); // cette fonction nous permet d'écrir dans un fichier, 
//comme il n'existe pas encore, le 'w' va le créer,
//le nom du fichier sera l'id de l'article, suivi de .php, et ils seront tous accessible depuis la page d'accueil
fwrite($fp, "<?php
echo\"
<html lang='fr'>
   <head>
      <meta charset='utf-8'>
	  <title>15 Minutes, information irrégulière</title>
	  <link rel='stylesheet' href='style2.css'>
   </head>
      <body background='gris.jpg'> 
<table align='center' bgcolor='white'>
<tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font>\"; 
include('menu.php');
echo\"<table align='center' bgcolor='white'>
<tr><td align='center'>
<h2>$title</h2>
</td></tr>
</br>
</br>
<tr><td align='center'>
<font size=4><p>$article1</p></font>
</td></tr>
</table>
<table align='left'>
<tr><td align='left'><font size=4>auteur: ".$_SESSION['login1']."</td></tr>
<tr><td>\";
include('commentaire.php');
echo\"</tr></td>\";
?>");
fclose($fp);
  }
 }

?>
