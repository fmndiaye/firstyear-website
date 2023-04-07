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
<tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1> </font> 
";
include("menu.php");
echo"
<table align='center'>
</td> </tr>
<tr> <td> <p align='center'> <font size=6> Bienvenu sur le site de 15 Minutes!</br>

<font size=4>
Sur notre site, nous vous proponsons des articles à la une, et bien d'autre choses</br>
qui éveillerons surement votre curiosité. De plus, pour ceux d'entre vous qui aimeraient</br> 
contribuer au contenu des articles, vous pouvez vous même écrire un article sur notre site</br>
et il sera visible par tous!";
if(!isset($_SESSION['connecte'])){
	echo"La seule chose que vous avez à faire: c'est vous <a href='inscription.php'>inscrire!</a></br>
Et c'est totalement gratuit ! Alors qu'attendez-vous?
</td></tr>
<tr><td align='center'>
<font size=4>pour voir les articles, passer votre souris 'article', sur la barre</br>
de menu, ou consulter les articles récents ci-dessous.</p>";
}
echo"
</td> </tr>
<tr> <td> <img src='journal.jpg'> </td> </tr>
";
include('madeart.php');
?>	 