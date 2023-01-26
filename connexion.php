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
            $login = htmlspecialchars($_POST['login']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $password = $_POST['password']; // md5'() pour crypet le mdp

            if (!empty($login) && !empty($password)) {
                $recupUser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
                $recupUser->execute([$login, $password]);

                if ($recupUser->rowCount() > 0) {
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
                    $_SESSION['users'] = $recupUser->fetchAll(PDO::FETCH_ASSOC);
                    header("Location: index.php");
                } else {
                    echo 'Votre login ou mot de passe incorect';
                }
            } else {
                echo 'Veuillez compléter tous les champs';
            }
        }
        ?>
        <form method="POST" action="">
            <label for="login">Login : </label>
            <input type="text" id="login" name="login" required autofocus>
            <br>
            <label for="password">Password : </label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" name="envoi">
        </form>
    </main>

</body>

</html>