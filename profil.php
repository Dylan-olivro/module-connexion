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
    <title>Profil</title>
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
            $id = $_SESSION['users'][0]['id'];

            $recupUser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND id != ?");
            $recupUser->execute([$login, $id]);
            $insertUser = $bdd->prepare("UPDATE utilisateurs SET login = ? , prenom = ? , nom = ? , password=  ? WHERE id = ?");

            if (empty($login) || empty($prenom) || empty($nom) || empty($password) || empty($_POST['cpassword'])) {
                echo "Veuillez complétez tous les champs...";
            } elseif (!preg_match("#^[a-z0-9]+$#", $login)) {
                echo "Le login doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
            } elseif ($password != $_POST['cpassword']) {
                echo 'Les deux mots de passe sont differents';
            } elseif ($recupUser->rowCount() == 1) {
                echo "Ce login est déjà utilisé.";
            } else {
                $insertUser->execute([$login, $prenom, $nom, $password, $id]);
                $_SESSION['users'][0]['login'] = $login;
                $_SESSION['users'][0]['prenom'] = $prenom;
                $_SESSION['users'][0]['nom'] = $nom;
                header("Location: profil.php");
            }
        }
        ?>
        <form method="post" action="profil.php">
            <label for="login">Login (a-z0-9) : </label>
            <input type="text" name="login" id="login" value="<?= $_SESSION['users'][0]['login']  ?>" required />
            <br />
            <label for="prenom">Prénom : </label>
            <input type="text" name="prenom" id="prenom" value="<?= $_SESSION['users'][0]['prenom']  ?>" required />
            <br />
            <label for="nom">Nom : </label>
            <input type="text" name="nom" id="nom" value="<?= $_SESSION['users'][0]['nom']  ?>" />
            <br />
            <label for="password">Mot de pass : </label>
            <input type="password" name="password" id="password" value="<?= $_SESSION['users'][0]['password'] ?>" required />
            <br />
            <label for="cpassword">Confirmation : </label>
            <input type="password" name="cpassword" id="cpassword" value="<?= $_SESSION['users'][0]['password'] ?>" required />
            <br />
            <input type="submit" name="envoi">
        </form>

    </main>
    <footer><a href="https://github.com/Dylan-olivro">Mon GitHub</a></footer>
</body>

</html>