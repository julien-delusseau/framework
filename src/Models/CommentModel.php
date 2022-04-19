<?php

namespace App\Models;

use PDO;

class CommentModel extends Database
{
    /**
     * Méthode pour connaître le nombre de lignes dans notre table.
     * @return mixed
     */
    public static function getCount(): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
            SELECT count(id) AS total FROM comments
        ');
        $query->execute();
        return $query->fetch(PDO::FETCH_NUM);
    }


    public static function getItems(int $limit = 10, int $offset = 0): array|bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT 
               comments.id AS id,
               comments.created_at AS created_at,
               comments.content AS content, 
               concat(users.firstname, " ", users.lastname) AS fullname,
               slug,
               title
        FROM comments
        JOIN posts
        ON comments.post_id = posts.id
        JOIN users
        ON comments.user_id = users.id
        ORDER BY created_at DESC
        LIMIT ' . $limit . ' OFFSET ' . $offset);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour chercher tous les commentaires par l'ID d'un article
     * @param int $postId
     * @return array|false
     */
    public static function getCommentsByPost(int $postId): array|false
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT 
               comments.id AS comment_id,
               comments.content AS content, 
               users.firstname AS firstname, 
               users.lastname AS lastname, 
               users.image AS image,
               users.id AS user_id,
               date_format(posts.created_at, "%d/%m/%Y") AS "date",
               slug
        FROM comments
        JOIN posts
        ON comments.post_id = posts.id
        JOIN users
        ON comments.user_id = users.id
        WHERE comments.post_id = :postId
        ORDER BY comments.created_at DESC;
        ');

        $query->execute(["postId" => $postId]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour chercher un commentaire par son ID
     * @param int $commentId
     * @return mixed
     */
    public static function getOneCommentById(int $commentId): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT 
               comments.id AS comment_id,
               comments.content AS content,
               users.id AS user_id,
               slug
        FROM comments
        JOIN posts
        ON comments.post_id = posts.id
        JOIN users
        ON comments.user_id = users.id
        WHERE comments.id = :commentId;
        ');

        $query->execute(["commentId" => $commentId]);
        $query->setFetchMode(PDO::FETCH_OBJ);

        return $query->fetch();
    }

    /**
     * Méthode pour chercher un commentaire par son contenu, grâce à un formulaire de recherche
     * @param string $content
     * @return array|false
     */
    public static function queryComment(string $content): array|false
    {
        $pdo = Database::getPDO();

        $research = "%" . $content . "%";

        $query = $pdo->prepare('
       SELECT 
               comments.id AS id,
               comments.created_at AS created_at,
               comments.content AS content, 
               concat(users.firstname, " ", users.lastname) AS fullname,
               slug,
               title
        FROM comments
        JOIN posts
        ON comments.post_id = posts.id
        JOIN users
        ON comments.user_id = users.id
        WHERE comments.content LIKE :content'
        );
        $query->execute(["content" => $research]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour créer un commentaire
     * @param string $content
     * @param int $postId
     * @param int $userId
     * @return bool
     */
    public static function createComment(string $content, int $postId, int $userId): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        INSERT INTO comments (content, post_id, user_id) VALUES
        (:content, :postId, :userId);
        ');

        return $query->execute([
            "content" => $content,
            "postId" => $postId,
            "userId" => $userId
        ]);
    }

    /**
     * Méthode pour modifier un commentaire par son ID
     * @param string $content
     * @param int $id
     * @return bool
     */
    public static function updateComment(string $content, int $id): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        UPDATE comments SET content = :content WHERE id = :id;
        ');

        return $query->execute([
            "content" => $content,
            "id" => $id
        ]);
    }

    /**
     * Méthode pour supprimer un commentaire par son ID
     * @param int $commentId
     * @return bool
     */
    public static function deleteComment(int $commentId): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        DELETE FROM comments
        WHERE id = :commentId
        ');

        return $query->execute([
            "commentId" => $commentId
        ]);
    }
}