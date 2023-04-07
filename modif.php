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
if(!isset($_SESSION['connecte'])){	
	  echo"<table align='center'>
	  <tr><td>
	  <font size=5 color='red'> Veuillez vous connectez(ou vous inscrir <a href='inscription.php'>ici</a>)
	  afin d'accèder à l'espace membres !
	  </font>
	  </td></tr>
	  </table>"; 

	  } else {

$article=$_POST['article'];
$article1 = $article;

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
 
 $req="SELECT titre, contenu, id
       FROM articles
	   WHERE id='$article1'";
	   //requête sql, on récupère l'article en question, via l'id récupèré du formulaire, en type hidden
 $result = mysql_query($req) or die('Erreur SQL!'.$req.'<br>'.mysql_error()); // permet d'afficher l'erreur, en cas d'erreur
 $dat = mysql_fetch_assoc($result);
 
 $ti = $dat['titre'];
 $cont = $dat['contenu'];
 $id1 = $dat['id'];
 
 echo"
 <form action='modifier.php' method='POST'>
<table align='center' bgcolor='white'>
<tr><td>
<font size=5>Titre de l'article</td>
<td>
<input type='text' name='title' placeholder='titre' value='$ti'>
</td></tr>
<table align='center'>
<tr><td align='center'>
<font size=5> Modifier votre article:
</td></tr>
<tr><td>
<textarea rows='30' cols ='90' name='article2'>$cont</textarea> 
</td> </tr>
<input type='hidden' name='id' value='$id1'>
<tr><td align='center'>
<input type='submit' value='Envoyer'>
<input type='reset' value ='Effacer'>
</td></tr>
</form>";	   
	  }
?>