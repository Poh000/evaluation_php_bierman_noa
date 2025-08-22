<?php

function isUserByEmailExist($email): bool
{
    $connexion = getConnection();
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
        $connexion = getConnection();
        $request = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $prep = $connexion->prepare($request);
        $prep->execute($tab);
        $message = "Compte ajouté avec succès !";
    } catch (PDOException $e) {
        $message = "Erreure Tableau";
    }
}

function findUserByEmail($email)
    {
        try {
            $connexion = getConnection();
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
