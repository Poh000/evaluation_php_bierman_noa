<?php

function isCategoryExist($category): bool
{
    $connexion = getConnection();
    try {
        $request = "SELECT c.id_category FROM category AS c WHERE c.name = ?";
        $req = $connexion->prepare($request);
        $req->bindParam(1, $category, \PDO::PARAM_STR);
        $req->execute();
        $count = $req->fetchColumn();
        return $count > 0;
    } catch (\Exception $e) {
        return false;
    }
}


function findCategoryByName($category)
    {
        try {
            $connexion = getConnection();
            $request = "SELECT c.id_category FROM category AS c WHERE c.name = ?";
            $req = $connexion->prepare($request);
            $req->bindParam(1, $category, \PDO::PARAM_STR);
            $req->execute();
            $req->setFetchMode(\PDO::FETCH_ASSOC);
            return $req->fetchColumn();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }