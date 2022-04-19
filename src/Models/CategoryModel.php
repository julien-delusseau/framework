<?php

namespace App\Models;

use PDO;

class CategoryModel extends Database
{
    /**
     * Méthode pour connaître le nombre de lignes dans notre table.
     * @return mixed
     */
    public static function getCount()
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
            SELECT count(id) AS total FROM categories
        ');
        $query->execute();
        return $query->fetch(PDO::FETCH_NUM);
    }

    /**
     * Méthode pour chercher toutes nos catégories et le nombre d'articles
     * @return array|false
     */
    public static function getItems()
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT c.id, c.name, count(pc.post_id) AS count, c.created_at
        FROM categories c
        LEFT JOIN posts_categories pc 
        ON c.id = pc.category_id 
        GROUP BY c.id
        ORDER BY count DESC;
        ');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour lister toutes nos catégories
     * @return array|false
     */
    public static function listCategories()
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT c.id, c.name, c.created_at
        FROM categories c
        ORDER BY c.created_at DESC
        ');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour chercher une catégorie par son ID
     * @param int $id
     * @return mixed
     */
    public static function getOneCategory(int $id)
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        SELECT id, name
        FROM categories
        WHERE id = :id;
        ');

        $query->execute([
            "id" => $id,
        ]);

        $query->setFetchMode(PDO::FETCH_OBJ);
        return $query->fetch();
    }

    /**
     * Méthode pour créer une nouvelle catégorie
     * @param string $name
     * @return bool
     */
    public static function createCategory(string $name): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        INSERT INTO categories (name)
        VALUES (:name)
        ');
        return $query->execute([
            "name" => $name
        ]);
    }

    /**
     * Méthode pour affecter un article à une catégorie
     * @param int $postId
     * @param int $categoryId
     * @return bool
     */
    public static function addPostToCategory(int $postId, int $categoryId): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        INSERT INTO posts_categories (post_id, category_id)
        VALUES (:postId, :categoryId)
        ');
        return $query->execute([
            "postId" => $postId,
            "categoryId" => $categoryId
        ]);
    }

    /**
     * Méthode pour changer le nom d'une catégorie
     * @param string $name
     * @param int $id
     * @return bool
     */
    public static function updateCategoryName(string $name, int $id): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        UPDATE categories 
        SET name = :name
        where id = :id
        ');
        return $query->execute([
            "name" => $name,
            "id" => $id
        ]);
    }

    /**
     * Méthode pour supprimer une catégorie
     * @param int $id
     * @return bool
     */
    public static function deleteCategory(int $id): bool
    {
        $pdo = Database::getPDO();

        if (self::deletePostsFromCategory($id))
        {
            $query = $pdo->prepare('
            DELETE FROM categories 
            where id = :id
            ');

            return $query->execute([
                "id" => $id
            ]);
        }
        return false;
    }

    /**
     * Méthode pour supprimer tous les articles, suivant la catégorie
     * @param int $id
     * @return bool
     */
    public static function deletePostsFromCategory(int $id): bool
    {
        $pdo = Database::getPDO();

        $query = $pdo->prepare('
        DELETE posts
        FROM categories
        JOIN posts_categories ON posts_categories.category_id = categories.id
        JOIN posts ON posts.id = posts_categories.post_id 
        WHERE categories.name = "sciences"
        ');

        return $query->execute([
            "id" => $id
        ]);
    }
}