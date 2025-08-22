<?php

function isBookExist($book): bool
{
    $connexion = getConnection();
    try {
        $request = "SELECT b.id_book FROM book AS b WHERE b.title = ?";
        $req = $connexion->prepare($request);
        $req->bindParam(1, $book, \PDO::PARAM_STR);
        $req->execute();
        $count = $req->fetchColumn();
        return $count > 0;
    } catch (\Exception $e) {
        return false;
    }
}

function AddBook($tab)
{
    try {
        $connexion = getConnection();
        $request = "INSERT INTO book (title, description, date_pub AS publication_date, author, id_category, id_users) VALUES (?, ?, ?, ?, ?, ?)";
        $prep = $connexion->prepare($request);
        $prep->execute($tab);
        $message = $tab;
        return $message;
    } catch (PDOException $e) {
        $message = "Erreure Tableau";
        return $message;
    }
}

function getBooksByUser($userId)
{
    $connexion = getConnection();
    $request = "SELECT b.title, b.description, b.publication_date, b.author, c.name FROM book AS b JOIN category AS c ON b.id_category = c.id_category WHERE b.id_users = ?";
    $prep = $connexion->prepare($request);
    $prep->execute([$userId]);
    return $prep->fetchAll(PDO::FETCH_ASSOC);
}
