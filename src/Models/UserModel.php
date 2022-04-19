<?php

namespace App\Models;

use PDO;

class UserModel extends Database
{
    /**
     * Méthode pour connaître le nombre de lignes dans notre table.
     * @return mixed
     */
    public static function getCount(): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
            SELECT count(id) AS total FROM users
        ');
        $query->execute();
        return $query->fetch(PDO::FETCH_NUM);
    }

    /**
     * Méthode pour chercher tous les utilisateurs
     * @param int $limit
     * @param int $offset
     * @return array|false
     */
    public static function getItems(int $limit = 10, int $offset = 0): array|false
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT id, firstname, lastname, email, image, description, role, created_at
        FROM users
        ORDER BY created_at DESC;
        LIMIT '. $limit .' OFFSET ' . $offset);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour chercher un utilisateur par son email
     * @param string $email
     * @return mixed
     */
    public static function searchUserByEmail(string $email): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('SELECT DATE_FORMAT(users.created_at, "%d/%m/%Y") AS "date", firstname, lastname, email, image, description, role, password, id, token
            FROM users WHERE email = :email');
        $query->execute(["email" => $email]);
        $query->setFetchMode(PDO::FETCH_OBJ);
        return $query->fetch();
    }

    /**
     * Méthode pour chercher un utilisateur par son ID
     * @param int $id
     * @return mixed
     */
    public static function searchUserById(int $id): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('SELECT DATE_FORMAT(users.created_at, "%d/%m/%Y") AS "date", firstname, lastname, email, image, description, role, password, id
            FROM users WHERE id = :id');
        $query->execute(["id" => $id]);
        $query->setFetchMode(PDO::FETCH_OBJ);
        return $query->fetch();
    }

    /**
     * Méthode pour chercher un utilisateur par son prénom et son nom
     * @param string $firstname
     * @param string $lastname
     * @return mixed
     */
    public static function searchUserByFullName(string $firstname, string $lastname): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT DATE_FORMAT(users.created_at, "%d/%m/%Y") AS "date", firstname, lastname, email, image, description, id, role
        FROM users WHERE firstname = :firstname AND lastname = :lastname'
        );
        $query->execute(["firstname" => $firstname, "lastname" => $lastname]);
        $query->setFetchMode(PDO::FETCH_OBJ);
        return $query->fetch();
    }

    /**
     * Méthode pour chercher un utilisateur par son token
     * @param string $token
     * @return mixed
     */
    public static function searchUserByToken(string $token): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT email
        FROM users WHERE token = :token;
        ');
        $query->execute([
            "token" => $token
        ]);
        $query->setFetchMode(PDO::FETCH_OBJ);
        return $query->fetch();
    }

    /**
     * Méthode pour chercher un utilisateur par son nom, grâce à un formulaire de recherche
     * @param string $lastname
     * @return array|false
     */
    public static function queryUser(string $lastname): array|false
    {
        $pdo = Database::getPDO();

        $research = "%".$lastname."%";

        $query = $pdo->prepare('
        SELECT DATE_FORMAT(users.created_at, "%d/%m/%Y") AS "created_at", firstname, lastname, email, image, description, id, role
        FROM users WHERE lastname LIKE :lastname'
        );
        $query->execute(["lastname" => $research]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour enregistrer un utilisateur
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     * @param string $token
     * @param string $role
     * @return bool
     */
    public static function registerUser(string $firstname, string $lastname, string $email, string $password, string $token, string $role = "ROLE_USER"): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        INSERT INTO users (firstname, lastname, email, password, token, role) VALUES
        (:firstname, :lastname, :email, :password, :token, :role)
        ');
        return $query->execute([
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "password" => $password,
            "token" => $token,
            "role" => $role
        ]);
    }

    /**
     * Méthode pour mettre à jour un utilisateur
     * @param int $id
     * @param string $email
     * @param string $firstname
     * @param string $lastname
     * @param string|null $description
     * @return mixed
     */
    public static function updateUser(int $id, string $email, string $firstname, string $lastname, ?string $description = null): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare("
        UPDATE users 
        SET firstname = :firstname, lastname = :lastname, email = :email, description = :description
        WHERE id = :id
        ");
        $query->execute([
            "id" => $id,
            "email" => $email,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "description" => $description,
        ]);
        return self::searchUserByEmail($email);
    }

    /**
     * Méthode pour changer le mot de passe d'un utilisateur
     * @param string $email
     * @param string $password
     * @return bool
     */
    public static function updateUserPassword(string $email, string $password): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare("
        UPDATE users 
        SET password = :password
        WHERE users.email = :email
        ");

        return $query->execute([
            "email" => $email,
            "password" => $password
        ]);
    }

    /**
     * Méthode pour supprimer un utilisateur par son ID
     * @param int $id
     * @return bool
     */
    public static function deleteUser(int $id): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare("
        DELETE FROM users 
        WHERE id = :id
        ");

        return $query->execute([
            "id" => $id
        ]);
    }

    public static function uploadImage(string $image, int $id)
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        UPDATE users 
        SET image = :image
        WHERE id = :id;
        ');

        return $query->execute([
            "image" => $image,
            "id" => $id
        ]);
    }
}