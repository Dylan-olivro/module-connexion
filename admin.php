<?php
session_start();
require "config.php";

if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/common.css">
    <title>Admin</title>
</head>

<body>
    <header>
        <img src="./assets/logo-php.png" alt="logo">
        <nav>
            <?php
            require './header-include.php';
            ?>
        </nav>
    </header>

    <main>
        <?php
        $request = $bdd->query('SELECT * FROM utilisateurs');
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table>
            <thead>
                <tr>
                    <?php
                    foreach ($result[0] as $key => $value) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < sizeof($result); $i++) : ?>
                    <tr>
                        <td><?= $result[$i]['id'] ?></td>
                        <td><?= $result[$i]['login'] ?></td>
                        <td><?= $result[$i]['prenom'] ?></td>
                        <td><?= $result[$i]['nom'] ?></td>
                        <td><?= $result[$i]['password'] ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <style>
            main {
                display: flex;
                flex-direction: column;
            }

            table {
                border-collapse: collapse;
            }

            th,
            td {
                padding: 0.5em;
                border: 1px solid;
                text-align: center;
            }
        </style>
    </main>

    <footer><a href="https://github.com/Dylan-olivro">Mon GitHub</a></footer>
</body>

</html>