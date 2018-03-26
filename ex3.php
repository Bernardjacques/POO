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

if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email']))
{
    $_POST['login'] = filter_var($_POST['login'],FILTER_SANITIZE_STRING);
    $_POST['password'] = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $_POST['email'] = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

        $login = htmlspecialchars($_POST['login']);
        $password = sha1($_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        global $bdd;

        $emailreq = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $emailreq->execute(array($email));
        $emailexiste = $emailreq->rowcount();

        $loginreq = $bdd->prepare('SELECT * FROM user WHERE login = ?');
        $loginreq->execute(array($login));
        $loginexiste = $loginreq->rowcount();

        if($loginexiste == 0)
        {
            if($emailexiste == 0)
            {
                $insertutil= $bdd->prepare("INSERT INTO user (login, password, email) VALUES ('".$login."', '".$password."','".$email."')");
                $insertutil->execute(array(
                    "login" => $login, 
                    "password" => $password, 
                    "email" => $email));
                    header('location: index.php');
            }       
                else 
                {
                    $erreur = "Ce login/email existe déjà!";
                }
        }
        else 
        {
            $erreur = "Ce login/email est déjà utlisé!";
        }
}
else 
{
    $erreur = "Tous les champs ne sont pas rempli!";
}                 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="main.js"></script>
</head>
<body>
    <section class="formulaire"> 
        <h1>Inscription</h1>
            <div class="enregistrer">
            <form method="post" action="ex3.php">
                <div class="login">
                    login:
                        <input class="textarea" type="text" name="login" id="login" placeholder="login"
                           value=<?php if(isset($login))
                            { 
                               echo($login); 
                            }
                            ?>></br>
                </div>
                <div class="password">
                    Mot de passe:
                        <input class="textarea" type="password" name="password" id="password" placeholder="obligatoire"></br>
                </div>
                <div class="email">
                    Email:    
                        <input class="textarea" type="text" name="email" id="email" placeholder="obligatoire"
                            value=<?php if(isset($email)) 
                            {
                                echo($email); 
                            }
                            ?>></br>
                </div>
            </div>    
                <div class="envoyer"> 
                        <input class="button" type="submit" name="submit" value="Envoyer">
                </div> 
            </form>
                <?php 
                     if(isset($erreur))
                     {
                        echo '<font color= "red"> '.$erreur."</font>";
                     }
                ?> 
    </section>    
</body>
</html>