<?php
session_start();

include "./env.php";
include "./utils/tool.php";
include "./utils/bdd.php";
include "./model/user.php";
include "./model/book.php";
include "./model/category.php";



$message = "";
if (isset($_POST["submit"]) && !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["date_pub"]) && !empty($_POST["author"]) && !empty($_POST["category"])) {
    $title = sanitize($_POST["title"]);
    $description = sanitize($_POST["description"]);
    $date_pub = $_POST["date_pub"];
    $author = sanitize($_POST["author"]);
    $category = sanitize($_POST["category"]);
    $idActuel = $_SESSION["user_id"];
    if (!isBookExist($title)) {
        $idCategory = findCategoryByName($category);
        echo $idCategory;
        if (isCategoryExist($category)) {
            AddBook([$title, $description, $date_pub, $author,$idCategory, $idActuel]);
        } else {
            $message = "Cette catégorie n'éxiste pas";
        }
    } else {
        $message = "Ce livre est déjà publié";
    }
} else {
    $message = "Tous les champs ne sont pas remplis.";
}
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

        <form action="" method="post" enctype="multipart/form-data">
            <h2>Ajouter un livre</h2>
            <input type="text" name="title" placeholder="Titre du livre">
            <input type="text" name="description" placeholder="Description du livre">
            <input type="date" name="date_pub" placeholder="Date de publication">
            <input type="text" name="author" placeholder="Livre de quel auteur">
            <input type="text" name="category" placeholder="Livre de quelle catégorie">
            <input type="submit" value="inscription" name="submit">
            <p class="error"><?= $message ?></p>
        </form>

    </main>
</body>

</html>