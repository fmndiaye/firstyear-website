<?php echo"
<html lang='fr'>
<head>
    <meta charset='utf-8'>
	<title>Connexion</title>
<link rel='stylesheet' href='style2.css'>
</head>
<table align='center'> <tr> <td align='center'> <H1><font face='comic sans MS'> 15 MINUTES </H1></font> </td> </tr> </table>
";
include("menu.php");
echo"
<body>
  <form action='verif.php' method='POST'>
   <table align='center'>
    <tr>
     <td><font size=5>Votre login</td>
     <td> <input type='text' name='login1' placeholder='Pseudonyme'>
     </td>
    </tr>
    <tr>
     <td><font size=5>Votre mot de passe<b></td>
     <td>
      <input type='password' name='password1' placeholder='mot de passe'>
     </td>
    </tr>
     <tr>
   <td>
    <input type='submit' name='valide' value='Connexion'> Ou
    <a href='accueil.php'>Annuler</a>
</td>
</tr>
</form>
</table>";
?>