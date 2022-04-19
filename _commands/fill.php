<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cocur\Slugify\Slugify;
use App\Models\CategoryModel;

$faker = Faker\Factory::create();
$slugify = new Slugify();

$pdo = new PDO("mysql:host=localhost;dbname=framework", "root", "");

$pdo->exec("SET FOREIGN_KEY_CHECKS=0");
$pdo->exec("DELETE FROM posts");
$pdo->exec("DELETE FROM posts_categories");

for ($i = 0; $i < 10; $i++) {
    if (rand(0, 1) === 0) {
        $author = 1;
    } else {
        $author = 2;
    }
    $sentence = $faker->sentence();
    $query = $pdo->prepare('
        INSERT INTO posts (title, image, content, slug, author_id, created_at)
        VALUES (:title, :image, :content, :slug, :author_id, :created_at)
        ');

    $article = $query->execute([
        "title" => $sentence,
        "image" => $faker->imageUrl(640, 480, 'article', true),
        "content" => $faker->paragraphs(rand(3, 6), true),
        "slug" => $slugify->slugify($sentence),
        "author_id" => $author,
        "created_at" => $faker->iso8601()
    ]);
    $lastId = $pdo->lastInsertId();

    CategoryModel::addPostToCategory($lastId, rand(1, 3));
}
$pdo->exec("SET FOREIGN_KEY_CHECKS=1");