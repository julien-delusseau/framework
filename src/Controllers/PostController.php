<?php

namespace App\Controllers;

use App\Models\PostsModel;
use App\Models\CommentModel;
use Cocur\Slugify\Slugify;

class PostController extends MainController
{
    /**
     * La route par défaut
     * @param $slug
     * @return void
     */
    public function index($slug)
    {
        $article = PostsModel::getPostBySlug($slug);

        if (!$article) redirect('/error');

        $comments = CommentModel::getCommentsByPost($article->postID);

        $data = [
            "view" => "posts/show",
            "template" => "second_theme",
            "title" => html_entity_decode($article->title),
            "article" => $article,
            "comments" => $comments
        ];

        $this->generateView($data);
    }

    /**
     * La route pour créer un article
     * @return void
     */
    public function create()
    {
        if (!isGranted('admin') && !isGranted('author')) {
            redirect('/user/login');
        }

        $data = [
            "view" => "posts/create",
            "template" => "second_theme",
            "title" => "Création d'un article",
            "articleTitle" => "",
            "image" => "",
            "content" => "",
            "articleTitleError" => "",
            "imageError" => "",
            "categoryError" => "",
            "contentError" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slugify = new Slugify();
            $author_id = (int)$_SESSION['user']['id'];

            $articleTitle = htmlspecialchars($_POST['title']);
            $image = filter_var($_POST['image'], FILTER_SANITIZE_URL);
            $category = filter_var($_POST['category'], FILTER_VALIDATE_INT);
            $content = htmlspecialchars($_POST['content']);

            if (empty($articleTitle)) {
                $data["articleTitleError"] = "Merci de donner un titre à votre article.";
            }

            if (empty($image)) {
                $data["imageError"] = "Merci de donner une image à votre article.";
            }

            if ($category === 0) {
                $data["categoryError"] = "Merci de choisir une catégorie pour votre article.";
            } elseif (!is_int($category)) {
                $data["categoryError"] = "Merci de choisir une catégorie valide.";
            }

            if (empty($content)) {
                $data["contentError"] = "Merci de donner un corps à votre article.";
            } elseif (strlen($content) < 100) {
                $data["contentError"] = "100 caractères au minimum";
            }

            if (!empty($data["articleTitleError"]) || !empty($data["imageError"]) || !empty($data["contentError"]) || !empty($data["categoryError"])) {
                $data["articleTitle"] = $articleTitle;
                $data["image"] = $image;
                $data["content"] = $content;
                $this->generateView($data);
            }

            $article = PostsModel::createPost($articleTitle, $image, $content, $slugify->slugify($articleTitle), $author_id, $category);

            if ($article) {
                redirect('/' . $article->slug);
            } else {
                dd("Problème lors de la création de l'article");
            }
        }

        $this->generateView($data);
    }

    /**
     * La route pour modifier un article
     * @param string $slug
     * @return void
     */
    public function update(string $slug)
    {
        $article = PostsModel::getPostBySlug($slug);
        if (!$article) redirect();
        $this->isOwner($article);

        $data = [
            "view" => "posts/update",
            "template" => "second_theme",
            "title" => "Modification de l'article",
            "articleTitle" => $article->title,
            "image" => $article->post_image,
            "content" => $article->content,
            "articleTitleError" => "",
            "imageError" => "",
            "contentError" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleTitle = htmlspecialchars($_POST['title']);
            $image = filter_var($_POST['image'], FILTER_SANITIZE_URL);
            $content = htmlspecialchars($_POST['content']);

            if (empty($articleTitle)) {
                $data["articleTitleError"] = "Merci de donner un titre à votre article.";
            }

            if (empty($image)) {
                $data["imageError"] = "Merci de donner une image à votre article.";
            }

            if (empty($content)) {
                $data["contentError"] = "Merci de donner un corps à votre article.";
            } elseif (strlen($content) < 100) {
                $data["contentError"] = "100 caractères au minimum";
            }

            if (!empty($data["articleTitleError"]) || !empty($data["imageError"]) || !empty($data["contentError"])) {
                $this->generateView($data);
            }

            $success = PostsModel::updatePost($articleTitle, $image, $content, $slug);

            if ($success) {
                Toolbox::flashMessage("success", "Article modifié.");
                redirect('/' . $article->slug);
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la modification de l'article.");
                redirect('/' . $article->slug);
            }
        }

        $this->generateView($data);
    }

    /**
     * La route pour supprimer un article
     * @return void
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $id = filter_var($_POST['postId'], FILTER_VALIDATE_INT);

            if (PostsModel::deletePost($id)) {
                Toolbox::flashMessage("success", "Article supprimé.");
                redirect();
            }
            else {
                Toolbox::flashMessage("danger", "Erreur lors de la suppression.");
                redirect();
            }
        }
        else
        {
            Toolbox::flashMessage("danger", "Méthode interdite.");
            redirect();
        }
    }

    /**
     * La méthode pour vérifier si l'utilisateur est l'auteur de l'article
     * @param $article
     * @return void
     */
    private function isOwner($article)
    {
        if (!isGranted('admin') && $_SESSION['user']['id'] !== $article->userID) {
            redirect('/user/login');
        }
    }
}