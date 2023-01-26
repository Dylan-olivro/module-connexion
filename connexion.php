<?php
session_start();
require "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/common.css">
    <title>Connexion</title>
</head>

<body>
    <header>
        <img src="./assets/logo-php.png" alt="logo">
        <nav>
            <?php require './header-include.php' ?>
        </nav>
    </header>
    <main>
        <?php
        if (isset($_POST['envoi'])) {
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = htmlspecialchars($_POST['login']);
                $password = $_POST['password']; // md5'() pour crypet le mdp
                $recupUser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
                $recupUser->execute([$login, $password]);

                if ($recupUser->rowCount() > 0) {
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
                    $_SESSION['users'] = $recupUser->fetchAll(PDO::FETCH_ASSOC);
                    // $_SESSION['nom'] = $recupUser->fetch()['nom'];
                    // echo $_SESSION['id'];
                    header("Location: index.php");
                } else {
                    echo 'Votre login ou mot de passe incorect';
                }
            } else {
                echo 'Veuillez compléter tous les champs';
            }
        }


        // if (isset($_POST['envoi'])) {
        //     $login = htmlspecialchars($_POST['login']);
        //     $password = $_POST['password']; // md5'() pour crypet le mdp
        //     $recupUser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        //     $recupUser->execute([$login, $password]);

        //     if (empty($_POST['login']) || empty($_POST['password'])) {
        //         echo "Un champ est vide.";
        //     } else {
        //         $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
        //         $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");

        //         require 'config.php';
        //         if (!$bdd) {
        //             echo 'Erreur de connexion à la base de données.';
        //         } else {
        //             $Requete = $bdd->query("SELECT * FROM utilisateurs WHERE login = '" . $login . "' AND password = '" . $password . "'");
        //             $Requete->execute();
        //             $result = $Requete->fetchAll(PDO::FETCH_ASSOC);

        //             if (sizeof($result) == 0) {
        //                 echo "Le login ou le mot de passe est incorect, le compte n'a pas été trouvé";
        //             } else {
        //                 $_SESSION['login'] = $login;
        //                 echo 'vous etes connecter';
        //             }
        //         }
        //     }
        // }
        ?>
        <form method="POST" action="">
            <label for="login">Login : </label>
            <input type="text" id="login" name="login" autofocus>
            <br>
            <label for="password">Password : </label>
            <input type="password" id="password" name="password">
            <br>
            <input type="submit" name="envoi">
        </form>
    </main>

</body>

</html>