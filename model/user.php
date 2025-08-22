<?php

function isUserByEmailExist($email): bool
{
    $nouvelleCo = "mysql:host=" . BDD_SERVER . ";dbname=" . BDD_NAME . ";charset=utf8";
    $connexion = new PDO($nouvelleCo, BDD_LOGIN, BDD_PASSWORD);
    try {
        $request = "SELECT u.id_users FROM users AS u WHERE u.email = ?";
        $req = $connexion->prepare($request);
        $req->bindParam(1, $email, \PDO::PARAM_STR);
        $req->execute();
        $count = $req->fetchColumn();
        return $count > 0;
    } catch (\Exception $e) {
        return false;
    }
}

function AddUser($tab)
{
    try {
        $nouvelleCo = "mysql:host=" . BDD_SERVER . ";dbname=" . BDD_NAME . ";charset=utf8";
        $connexion = new PDO($nouvelleCo, BDD_LOGIN, BDD_PASSWORD);
        $request = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $prep = $connexion->prepare($request);
        $prep->execute([$tab]);
        $message = "Compte ajouté avec succès !";
    } catch (PDOException $e) {
        $message = "Ce mail est déjà utilisé";
    }
}

function findUserByEmail($email)
    {
        try {
            $nouvelleCo = "mysql:host=" . BDD_SERVER . ";dbname=" . BDD_NAME . ";charset=utf8";
            $connexion = new PDO($nouvelleCo, BDD_LOGIN, BDD_PASSWORD);
            $request = "SELECT u.id_users AS idUser,u.email, u.firstname, u.lastname, u.password FROM users AS u WHERE u.email = ?";
            $req = $connexion->prepare($request);
            $req->bindParam(1, $email, \PDO::PARAM_STR);
            $req->execute();
            $req->setFetchMode(\PDO::FETCH_ASSOC);
            return $req->fetch();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
