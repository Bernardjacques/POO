<?php

 session_start();
 $username = "root";
 $password = "user";
 $host = "localhost";
 $bdname = "exercice3";

try 
{

  $bdd = new PDO('mysql:dbname='.$bdname.';host='.$host.";charset=utf8", $username, $password);
}   

catch(Exception $e) 
{
  die('Erreur: ' .$e->getMessage());
}

if(isset($_POST['se_connecter'])) 
{
  if(!empty($_POST['pseudo']) AND !empty($_POST['mot_de_passe'])) 
  {
  $_POST['pseudo'] = filter_var($_POST['pseudo'],FILTER_SANITIZE_STRING);
  $_POST['mot_de_passe'] = filter_var($_POST['mot_de_passe'],FILTER_SANITIZE_STRING);

  $pseudo = htmlspecialchars($_POST['pseudo']);
  $mot_de_passe = sha1($_POST['mot_de_passe']);
  

    
  $requtil = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = ? AND mot_de_passe = ?');
  $requtil->execute(array($pseudo, $mot_de_passe));

    $utilinfo = $requtil->fetchAll(PDO::FETCH_ASSOC);
    if(count($utilinfo) == 1) 
    {
          $_SESSION['id'] = $utilinfo[0]['id'];
          $_SESSION['pseudo'] = $utilinfo[0]['pseudo'];
          $_SESSION['mot_de_passe'] = $utilinfo[0]['mot_de_passe'];
          //header("Location: /php-chat-db/chatroom.php/");
    }
    else 
    {
      $Error="vous n'êtes pas inscrit";
        echo($Error);
        echo($mot_de_passe);
    } 
  }  
}

if(isset($_POST['se_deconnecter']))
{
  session_unset();
  session_destroy();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EXERCICE 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<form method="post" action="index.php">
  <div class="inscription">
    <?php if(empty($_SESSION['pseudo'])): ?>
          <input class="button" type="text" name="pseudo" placeholder="Pseudo">
          <input class="button" type="password" name="mot_de_passe" placeholder="Mot De Passe">
          <input class="button" type="submit" name="se_connecter" value="Se connecter">
    <?php else : ?>
          <input class="button" type="submit" name="se_deconnecter" value="Se deconnecter">
    <?php endif; ?>
  </div>
</form> 
  <div class="button-inscription">
    <?php if(empty($_SESSION['pseudo'])): ?>
      <a href="ex3.php"><button>Inscription</button></a>
    <?php endif; ?>
  </div>
    <?php
         if(isset($erreur)) 
         {
            echo '<font color="red">'.$erreur."</font>";
         }
    ?>
</body>
</html>

