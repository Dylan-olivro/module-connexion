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
    <title>Inscription</title>
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

            $recupUser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
            $recupUser->execute([$login]);

            if (empty($login) || empty($prenom) || empty($nom) || empty($password) || empty($_POST['cpassword'])) {
                echo "Veuillez complétez tous les champs...";
            } elseif (!preg_match("#^[a-z0-9]+$#", $login)) {
                echo "Le login doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
            } elseif ($password != $_POST['cpassword']) {
                echo 'Les deux mots de passe sont differents';
            } elseif ($recupUser->rowCount() > 0) {
                echo "Ce login est déjà utilisé.";
            } else {
                $insertUser = $bdd->prepare("INSERT INTO utilisateurs(login, prenom, nom, password)VALUES(?,?,?,?)");
                $insertUser->execute([$login, $prenom, $nom, $password]);
                header("Location: index.php");
            }
        }
        ?>
        <form method="POST" action="">
            <label for="login">Login : </label>
            <input type="text" id="login" name="login" required autofocus>
            <br>
            <label for="prenom">Prénom : </label>
            <input type="text" id="prenom" name="prenom" required>
            <br>
            <label for="nom">Nom : </label>
            <input type="text" id="nom" name="nom" required>
            <br>
            <label for="password">Password : </label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="cpassword">Confirmation : </label>
            <input type="password" id="cpassword" name="cpassword" required>
            <br>
            <input type="submit" name="envoi">
        </form>
    </main>
</body>

</html>