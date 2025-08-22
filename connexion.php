<?php
include "./env.php";
include "./utils/bdd.php";
include "./utils/tool.php";
include "./model/user.php";

$message = "";
if (isset($_POST["submit"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (isUserByEmailExist($email) != 0) {
            $user = findUserByEmail($email);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION["connected"] = true;
                    $_SESSION["user_id"] = $user["idUser"];
                    $message = "Connexion réussie !";
                } else {
                    $message = "Mot de passe incorrect.";
                }
            } else {
                $message = "Cet email n'existe pas.";
            }
        } else {
            $message = "Tous les champs ne sont pas remplis.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style.css">
    <link rel="stylesheet" href="./public/pico.min.css">
    <title>Connexion</title>
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
            <h2>Se connecter</h2>
            <input type="email" name="email" placeholder="saisir le mail">
            <input type="password" name="password" placeholder="saisir le password">
            <input type="submit" value="Connexion" name="submit">
            <p class="error"><?= $message ?></p>
        </form>

    </main>
</body>

</html>