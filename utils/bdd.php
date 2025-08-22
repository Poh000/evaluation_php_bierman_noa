<?php

function getConnection() {
    return new PDO(
        "mysql:host=" . BDD_SERVER . ";dbname=" . BDD_NAME . ";charset=utf8",
        BDD_LOGIN,
        BDD_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}

