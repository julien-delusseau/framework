<?php

namespace App\Models;

use PDO;

class PostsModel extends Database
{

    /**
     * Méthode pour connaître le nombre de lignes dans notre table.
     * @return mixed
     */
    public static function getCount(): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
            SELECT count(id) AS total FROM posts
        ');
        $query->execute();
        return $query->fetch(PDO::FETCH_NUM);
    }


    /**
     * @param int $limit
     * @param int $offset
     * @return array|bool
     */
    public static function getItems(int $limit = 10, int $offset = 0): array|bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->query('
               SELECT title, 
               posts.content,
               slug, 
               firstname, 
               lastname, 
               date_format(posts.created_at, "%d/%m/%Y") AS "date", 
               categories.id AS category_id, 
               categories.name AS category_name, 
               posts.image AS post_image,
               posts.id AS post_id,
               users.id AS userID,
               users.image AS user_image,
               users.email AS user_email,
               count(comments.post_id) as comments
        FROM posts
        JOIN users
        ON posts.author_id = users.id
        JOIN posts_categories pc
        ON posts.id = pc.post_id
        JOIN categories
        ON categories.id = pc.category_id
        left join comments
        on posts.id = comments.post_id
        group by posts.id
        ORDER BY posts.created_at DESC
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour trouver les articles par auteur
     * @param int $authorId
     * @param int $limit
     * @return array|bool
     */
    public static function getPostsByAuthor(int $authorId, int $limit = 3): array|bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT title, 
           posts.content,
           slug, 
           firstname, 
           lastname, 
           date_format(posts.created_at, "%d/%m/%Y") AS "date", 
           categories.id AS category_id, 
           categories.name AS category_name, 
           posts.image AS post_image,
           posts.id AS post_id,
           users.id AS userID,
           users.image AS user_image,
           users.email AS user_email,
           count(comments.post_id) AS comments
        FROM posts
        JOIN users
        ON posts.author_id = users.id
        JOIN posts_categories pc
        ON posts.id = pc.post_id
        JOIN categories
        ON categories.id = pc.category_id
        LEFT JOIN comments
        ON posts.id = comments.post_id
        WHERE posts.author_id = :author
        GROUP BY posts.id
        ORDER BY posts.created_at desc
        LIMIT ' . $limit);
        $query->execute([
            "author" => $authorId
        ]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour chercher les derniers articles créés
     * @param int $limit
     * @return array|false
     */
    public static function getLatestPosts(int $limit): array|false
    {
        $pdo = Database::getPDO();

        $query = $pdo->query('
               SELECT title,
               slug,
               date_format(posts.created_at, "%d/%m/%Y") AS "date",
               count(comments.post_id) as comments
        FROM posts
        left join comments
        on posts.id = comments.post_id
        group by posts.id
        ORDER BY posts.created_at DESC
        LIMIT ' . $limit);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour chercher un article par son slug
     * @param string $slug
     * @return mixed
     */
    public static function getPostBySlug(string $slug): mixed
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare("
        SELECT 
               title, 
               slug,
               posts.image AS post_image, 
               posts.content, 
               date_format(posts.created_at, '%d/%m/%Y') AS 'date', 
               firstname, 
               lastname, 
               users.image AS userImage, 
               users.id AS userID,
               posts.id AS postID,
               posts.author_id,
               count(comments.post_id) as comments
        FROM posts
        JOIN users
        ON posts.author_id = users.id
        left join comments
        on posts.id = comments.post_id
        WHERE posts.slug = :slug
        GROUP BY posts.id;
        ");
        $query->execute(["slug" => $slug]);
        $query->setFetchMode(PDO::FETCH_OBJ);

        return $query->fetch();
    }

    /**
     * Méthode pour trouver le nombre d'articles par catégorie
     * @param string $name
     * @return array|false
     */
    public static function getPostsCountByCategoryName(string $name): array|false
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT count(posts.id) AS total
        FROM posts
        JOIN posts_categories pc
        ON posts.id = pc.post_id
        JOIN categories
        ON categories.id = pc.category_id
        WHERE categories.name = :name;
        ');
        $query->execute([
            "name" => $name
        ]);
        return $query->fetch(PDO::FETCH_NUM);
    }

    /**
     * Méthode pour chercher tous les articles par nom de catégorie
     * @param string $categoryName
     * @param int $limit
     * @param int $offset
     * @return array|false
     */
    public static function getPostsByCategoryName(string $categoryName): array|false
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT title, 
               posts.content,
               slug, 
               firstname, 
               lastname, 
               date_format(posts.created_at, "%d/%m/%Y") AS "date", 
               categories.id AS category_id, 
               categories.name AS category_name, 
               posts.image AS post_image,
               posts.id AS post_id,
               users.id AS userID,
               users.image AS user_image,
               users.email AS user_email,
               count(comments.id) AS comments
        FROM posts
        JOIN users
        ON posts.author_id = users.id
        JOIN posts_categories pc
        ON posts.id = pc.post_id
        JOIN categories
        ON categories.id = pc.category_id
        LEFT JOIN comments
        ON comments.post_id = posts.id
        WHERE categories.name = :categoryName
        GROUP BY posts.id
        ORDER BY posts.created_at DESC;
        ');
        $query->execute([
            "categoryName" => $categoryName
        ]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour chercher un article par son titre, grâce à un formulaire de recherche
     * @param string $title
     * @return array|false
     */
    public static function queryPost(string $title): array|false
    {
        $pdo = Database::getPDO();

        $research = "%" . $title . "%";

        $query = $pdo->prepare('
        SELECT title, 
               slug, 
               firstname, 
               lastname, 
               date_format(posts.created_at, "%d/%m/%Y") AS "date", 
               name, 
               categories.id AS category_id, 
               posts.image AS postImage,
               posts.id AS post_id,
               users.id AS userID,
               users.image AS user_image,
               users.email AS user_email
        FROM posts
        JOIN users
        ON posts.author_id = users.id
        JOIN posts_categories pc
        ON posts.id = pc.post_id
        JOIN categories
        ON categories.id = pc.category_id
        WHERE title LIKE :title'
        );
        $query->execute(["title" => $research]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour la création d'un article
     * @param string $title
     * @param string $image
     * @param string $content
     * @param string $slug
     * @param int $author_id
     * @param int $category
     * @return mixed
     */
    public static function createPost(string $title, string $image, string $content, string $slug, int $author_id, int $category): mixed
    {
        $pdo = Database::getPDO();

        $pdo->exec("SET FOREIGN_KEY_CHECKS=0;");
        $query = $pdo->prepare('
        INSERT INTO posts (title, image, content, slug, author_id)
        VALUES (:title, :image, :content, :slug, :author_id)
        ');

        $article = $query->execute([
            "title" => $title,
            "image" => $image,
            "content" => $content,
            "slug" => $slug,
            "author_id" => $author_id
        ]);
        if (!$article) {
            return false;
        }

        $lastId = $pdo->lastInsertId();

        CategoryModel::addPostToCategory($lastId, $category);

        $query = $pdo->prepare('
        SELECT slug FROM posts WHERE posts.id = :id
        ');
        $query->execute(["id" => $lastId]);
        $query->setFetchMode(PDO::FETCH_OBJ);

        $pdo->exec("SET FOREIGN_KEY_CHECKS=1;");

        return $query->fetch();
    }

    /**
     * Méthode pour mettre à jour un article
     * @param string $title
     * @param string $image
     * @param string $content
     * @param string $slug
     * @return bool
     */
    public static function updatePost(string $title, string $image, string $content, string $slug): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        UPDATE posts SET
        title = :title,
        image = :image,
        content = :content
        WHERE posts.slug = :slug
        ');

        return $query->execute([
            "title" => $title,
            "image" => $image,
            "content" => $content,
            "slug" => $slug
        ]);
    }

    /**
     * Méthode pour supprimer un article
     * @param int $postId
     * @return bool
     */
    public static function deletePost(int $postId): bool
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('
        DELETE FROM posts
        WHERE id = :id
        ');
        return $query->execute(["id" => $postId]);
    }
}