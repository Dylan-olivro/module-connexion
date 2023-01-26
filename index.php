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
    <title>Index</title>
</head>

<body>
    <header>
        <img src="./assets/logo-php.png" alt="logo">
        <nav>
            <?php require './header-include.php' ?>
        </nav>
    </header>

    <main>
        <section class="first-section">
            <h1>Page d'accueil</h1>
            <p>Ceci est ma page d'accueil!</p>
        </section>
    </main>
    <footer><a href="https://github.com/Dylan-olivro">Mon GitHub</a></footer>
</body>

</html>