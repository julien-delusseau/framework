<?php

namespace App\Models;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    /**
     * Connexion à la base de données
     * @return PDO
     */
    private static function connect(): PDO
    {
        return new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    /**
     * Préparation des requêtes SQL
     * @return PDO
     */
    protected static function getPDO(): PDO
    {
        if (self::$pdo === null) {
            return self::$pdo = self::connect();
        }
        return self::$pdo;
    }
}