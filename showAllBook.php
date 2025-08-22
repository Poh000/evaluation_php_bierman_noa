<?php
session_start();

include "./env.php";
include "./utils/tool.php";
include "./utils/bdd.php";
include "./model/user.php";
include "./model/book.php";
include "./model/category.php";

$idActuel = $_SESSION["user_id"];
$books = getBooksByUser($idActuel);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style.css">
    <link rel="stylesheet" href="./public/pico.min.css">
    <title>Ajouter un livre</title>
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
    <main class="container-fluid">
        <h2>Liste des categories</h2>
        <table class="striped">
            <thead data-theme="dark">
                <th>Titre</th>
                <th>Description</th>
                <th>Date de publication</th>
                <th>Auteur</th>
                <th>Category</th>
            </thead>
            <?php foreach ($books as $book): ?>
                <!-- afficher le contenu de l'attribut name (Category) -->
                <tr>
                    <td><?= ($book["title"]) ?> </td>
                    <td><?= ($book["description"]) ?> </td>
                    <td><?= ($book["publication_date"]) ?> </td>
                    <td><?= ($book["author"]) ?> </td>
                    <td><?= ($book["name"]) ?> </td>
                </tr>
            <? endforeach; ?>
        </table>
</body>

</html>