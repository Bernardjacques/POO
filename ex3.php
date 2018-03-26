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

if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['mot_de_passe']) && !empty($_POST['email']))
{
    $_POST['login'] = filter_var($_POST['login'],FILTER_SANITIZE_STRING);
    $_POST['mot_de_passe'] = filter_var($_POST['mot_de_passe'],FILTER_SANITIZE_STRING);
    $_POST['email'] = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

        $login = htmlspecialchars($_POST['login']);
        $mot_de_passe = sha1($_POST['mot_de_passe']);
        $email = htmlspecialchars($_POST['email']);
        global $bdd;

        $emailreq = $bdd->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $emailreq->execute(array($email));
        $emailexiste = $emailreq->rowcount();

        $loginreq = $bdd->prepare('SELECT * FROM utilisateur WHERE login = ?');
        $loginreq->execute(array($login));
        $loginexiste = $loginreq->rowcount();

        if($loginexiste == 0)
        {
            if($emailexiste == 0)
            {
                $insertutil= $bdd->prepare("INSERT INTO utilisateur (login, mot_de_passe, email) VALUES ('".$login."', '".$mot_de_passe."','".$email."')");
                $insertutil->execute(array(
                    "login" => $login, 
                    "mot_de_passe" => $mot_de_passe, 
                    "email" => $email));
                    header('location: index.php');
            }       
                else 
                {
                    $erreur = "Votre email existe déjà!";
                }
        }
        else 
        {
            $erreur = "Ce login est déjà utlisé!";
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
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <section class="formulaire"> 
        <h1>Inscription</h1>
            <div class="enregistrer">
            <form method="post" action="ex3.php">
                <div class="login">
                    login:
                        <input class="button1" type="text" name="login" id="login" placeholder="login"
                           value=<?php if(isset($login))
                            { 
                               echo($login); 
                            }
                            ?>></br>
                </div>
                <div class="mot_de_passe">
                    Mot de passe:
                        <input class="button2" type="password" name="mot_de_passe" id="mot_de_passe" placeholder="obligatoire"></br>
                </div>
                <div class="email">
                    Eemail:    
                        <input class="button3" type="text" name="email" id="email" placeholder="obligatoire"
                            value=<?php if(isset($email)) 
                            {
                                echo($email); 
                            }
                            ?>></br>
                </div>
            </div>    
                <div class="envoyer"> 
                        <input class="button4" type="submit" name="submit" value="Envoyer">
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