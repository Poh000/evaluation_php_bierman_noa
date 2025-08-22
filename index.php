<?php
include "./env.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style.css">
    <link rel="stylesheet" href="./public/pico.min.css">
    <title>Accueil</title>
</head>

<body>
    <header class="container-fluid">
        <nav>
            <ul>
                <!-- Menu commun -->
                <li><strong><a href="<?= BASE_URL ?>/" data-tooltip="Page Accueil">Accueil</a></strong></li>
            </ul>
            <!-- Menu connecté -->
            <?php if (isset($_SESSION["connected"])) : ?>
                <ul>
                    <li><a href="<?= BASE_URL ?>/showAllBook.php" data-tooltip="Liste des livres">Liste des livres</a></li>
                    <li><a href="<?= BASE_URL ?>/AddBook.php" data-tooltip="Ajouter un livre">Ajouter un livre</a></li>
                    <li><a href="<?= BASE_URL ?>/deconnexion.php" data-tooltip="Déconnexion">Se déconnecter</a></li>
                <?php else : ?>
                    <!-- Menu déconnecté -->
                    <li><a href="<?= BASE_URL ?>/register.php" data-tooltip="Créer un compte">Inscription</a></li>
                    <li><a href="<?= BASE_URL ?>/connexion.php" data-tooltip="Se connecter">Connexion</a></li>
                <?php endif ?>
                </ul>
        </nav>
    </header>
</body>

</html>