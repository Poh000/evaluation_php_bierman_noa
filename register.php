<?php

include "./env.php";
include "./utils/tool.php";
include "./utils/bdd.php";
include "./model/user.php";

$message = "";
if (isset($_POST["submit"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $firstname = sanitize($_POST["firstname"]);
    $lastname = sanitize($_POST["lastname"]);
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo isUserByEmailExist($email);
        if (!isUserByEmailExist($email)) {
            AddUser([$firstname, $lastname, $email, $hashPassword]);
            $message = "Inscription réussie";
        } else {
            $message = "Ce mail est déjà utilisé";
        }
    } else {
        $message = "L'email n'est pas valide.";
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
    <title>Inscription</title>
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
            <h2>S'inscrire</h2>
            <input type="text" name="firstname" placeholder="saisir le prénom">
            <input type="text" name="lastname" placeholder="saisir le nom">
            <input type="email" name="email" placeholder="saisir le mail">
            <input type="password" name="password" placeholder="saisir le password">
            <input type="submit" value="inscription" name="submit">
            <p class="error"><?= $message ?></p>
        </form>

    </main>
</body>

</html>