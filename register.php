<?php
include "./env.php";
include "./utils/tool.php";


$message = "";
if (isset($_POST["submit"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $nom = sanitize($_POST["firstname"]);
    $prenom = sanitize($_POST["lastname"]);
    $email = sanitize($_POST["email"]);
    $mdp = sanitize($_POST["password"]);
    $hashmdp = password_hash($mdp,PASSWORD_DEFAULT);
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $message = "Compte ajouté";
    } else {
        $message = "L'email n'est pas un email";
    }
} else {
    $message = "Tous les champs ne sont pas remplis";
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
            <!-- Menu connecté -->
            <?php if (isset($_SESSION["connected"])) : ?>
                <ul>
                    <li><a href="<?= BASE_URL ?>/book/all" data-tooltip="Liste des livres">Liste des livres</a></li>
                    <li><a href="<?= BASE_URL ?>/book/add" data-tooltip="Ajouter un livre">Ajouter un livre</a></li>
                    <li><a href="<?= BASE_URL ?>/user/deconnexion" data-tooltip="Déconnexion">Se déconnecter</a></li>
                <?php else : ?>
                    <!-- Menu déconnecté -->
                    <li><a href="<?= BASE_URL ?>/user/register" data-tooltip="Créer un compte">Inscription</a></li>
                    <li><a href="<?= BASE_URL ?>/user/connexion" data-tooltip="Se connecter">Connexion</a></li>
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