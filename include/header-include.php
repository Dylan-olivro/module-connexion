 <?php
    if (isset($_SESSION['login'])) {
        echo '<a href="./index.php">Accueil</a>';
        echo '<a href="./profil.php">Profil</a>';
        if ($_SESSION['login'] == 'admin') {
            echo '<a href="./admin.php">Admin</a>';
        }
        echo '<a href="./logout.php">LogOut</a>';
    } else {
        echo '<a href="./index.php">Accueil</a>';
        echo '<a href="./connexion.php">Se connecter</a>';
        echo '<a href="./inscription.php">S\'inscrire</a>';
    }
