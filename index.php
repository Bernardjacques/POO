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
  if(!empty($_POST['login']) AND !empty($_POST['password'])) 
  {
  $_POST['login'] = filter_var($_POST['login'],FILTER_SANITIZE_STRING);
  $_POST['password'] = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

  $login = htmlspecialchars($_POST['login']);
  $password = sha1($_POST['password']);
  

    
  $requtil = $bdd->prepare('SELECT * FROM user WHERE login = ? AND password = ?');
  $requtil->execute(array($login, $password));

    $utilinfo = $requtil->fetchAll(PDO::FETCH_ASSOC);
    if(count($utilinfo) == 1) 
    {
          $_SESSION['id'] = $utilinfo[0]['id'];
          $_SESSION['login'] = $utilinfo[0]['login'];
          $_SESSION['password'] = $utilinfo[0]['password'];
          //header("Location: /php-chat-db/chatroom.php/");
    }
    else 
    {
      $Error="vous n'êtes pas inscrit";
        echo($Error);
        echo($password);
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
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="main.js"></script>
</head>
<body>
<form method="post" action="index.php">
  <div class="inscription">
    <?php if(empty($_SESSION['login'])): ?>
          <input class="textarea" type="text" name="login" placeholder="login">
          <input class="textarea" type="password" name="password" placeholder="Mot De Passe">
          <input class="button" type="submit" name="se_connecter" value="Se connecter">
    <?php else : ?>
          <input class="button" type="submit" name="se_deconnecter" value="Se deconnecter">
    <?php endif; ?>
  </div>
</form> 
  <div class="button-inscription">
    <?php if(empty($_SESSION['login'])): ?>
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

