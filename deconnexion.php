<?php
include('menu.php');
session_destroy();
echo"<html>
<head>
<title>Déconnecté(e)</title>
<link rel='stylesheet' href='style2.css'>
</head>
<body>
<table align='center'>
 <tr> <td>
 <font size=5 color='green'>Vous êtes bien déconnectez, cliquez <a href='accueil.php'>ici</a> </br>
 pour retourner a la page d'accueil, où utilisez le menu ci-dessus 
</font> 
</td> </tr> 
</table>
</body>
</html>";
?>
