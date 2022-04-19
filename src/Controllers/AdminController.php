<?php

namespace App\Controllers;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

use App\Models\CommentModel;
use App\Models\PostsModel;
use App\Models\UserModel;
use App\Models\CategoryModel;

class AdminController extends MainController
{
    /**
     * On redirige l'utilisateur s'il n'est pas admin
     */
    public function __construct()
    {
        if (!isGranted('admin')) {
            redirect();
        }
    }

    /**
     * La route par défaut
     * @return void
     */
    public function index()
    {
        $posts = PostsModel::getItems(3);
        $users = UserModel::getItems(3);

        $data = [
            "view" => "admin/index",
            "template" => "admin",
            "title" => "Page admin",
            "posts" => $posts,
            "users" => $users
        ];
        $this->generateView($data);
    }

    /**
     * La route pour les articles
     * @return void
     */
    public function posts()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);

            $posts = PostsModel::queryPost($title);

            $data = [
                "view" => "admin/pages/posts",
                "template" => "admin",
                "title" => "Les articles",
                "posts" => $posts,
                "pages" => 1,
                "currentPage" => 1,
                "buttons" => "posts"
            ];
            $this->generateView($data);
        }

        $pagination = $this->adminPagination("PostsModel", 8, '/admin/posts');

        $data = [
            "view" => "admin/pages/posts",
            "template" => "admin",
            "title" => "Les articles",
            "posts" => $pagination['items'],
            "pages" => $pagination['pages'],
            "currentPage" => $pagination['currentPage'],
            "buttons" => "posts"
        ];
        $this->generateView($data);
    }

    /**
     * La route pour supprimer un article
     * @param int $id
     * @return void
     */
    public function deletePost(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (PostsModel::deletePost($id)) {
                Toolbox::flashMessage("success", "Article supprimé.");
                redirect('/admin/posts');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la suppression.");
                redirect('/admin/posts');
            }
        } else {
            Toolbox::flashMessage("danger", "Méthode interdite.");
            redirect();
        }
    }

    /**
     * La route des utilisateurs
     * @return void
     */
    public function users()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lastname = htmlspecialchars($_POST['lastname']);

            $user = UserModel::queryUser($lastname);

            $data = [
                "view" => "admin/pages/users",
                "template" => "admin",
                "title" => "Les utilisateurs",
                "users" => $user,
                "pages" => 1,
                "currentPage" => 1,
                "buttons" => "users"
            ];
            $this->generateView($data);
        }
        $pagination = $this->adminPagination("UserModel", 8, '/admin/users');

        $data = [
            "view" => "admin/pages/users",
            "template" => "admin",
            "title" => "Les utilisateurs",
            "users" => $pagination['items'],
            "pages" => $pagination['pages'],
            "currentPage" => $pagination['currentPage'],
            "buttons" => "users"
        ];
        $this->generateView($data);
    }

    /**
     * La route pour modifier un utilisateur
     * @param $id
     * @return void
     */
    public function update($id)
    {
        $profil = UserModel::searchUserById($id);

        if (!$profil) redirect('/admin');

        $data = [
            "view" => "admin/pages/update",
            "template" => "admin",
            "title" => "Modifier cet utilisateur",
            "profil" => $profil,
            "emailError" => "",
            "firstnameError" => "",
            "lastnameError" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (empty($_POST['email'])) {
                $data["emailError"] = "Merci de renseigner une adresse email";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $data["emailError"] = "Adresse email non valide";
            }

            if (empty($_POST['firstname'])) {
                $data["firstnameError"] = "Merci de renseigner votre prénom";
            }

            if (empty($_POST['lastname'])) {
                $data["lastnameError"] = "Merci de renseigner votre nom";
            }

            if (!empty($data["emailError"]) || !empty($data["firstnameError"]) || !empty($data["lastnameError"])) {
                $this->generateView($data);
            }

            $email = htmlspecialchars($_POST['email']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $description = htmlspecialchars($_POST['description']);

            $user = UserModel::updateUser($email, $firstname, $lastname, $description);

            if ($user !== false) {
                redirect('/admin/users');
            }
        }
        $this->generateView($data);
    }

    /**
     * La route pour supprimer un utilisateur
     * @param $id
     * @return void
     */
    public function deleteUser($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = UserModel::searchUserById($id);
            $image = "";

            if ($user->role === "ROLE_ADMIN")
            {
                Toolbox::flashMessage("danger", "Vous ne pouvez pas supprimer un administrateur.");
                redirect('/admin/users');
            }

            if($user) {
                if (!empty($user->image)) {
                    $image = $user->image;
                }

                if (UserModel::deleteUser($user->id)) {
                    if (!empty($image)) {
                        unlink(ROOT . '/public/assets/uploads/' . $image);
                    }
                    Toolbox::flashMessage("success", "Utilisateur supprimé avec succès.");
                    redirect('/admin/users');
                }
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la suppression de cet utilisateur.");
                redirect('/admin/users');
            }
        }
    }

    /**
     * La route des commentaires
     * @return void
     */
    public function comments()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = htmlspecialchars($_POST['content']);

            $comments = CommentModel::queryComment($content);

            $data = [
                "view" => "admin/pages/comments",
                "template" => "admin",
                "title" => "Tous les commentaires",
                "comments" => $comments,
                "pages" => 1,
                "currentPage" => 1,
                "buttons" => "comments"
            ];
            $this->generateView($data);
        }

        $pagination = $this->adminPagination("CommentModel", 8, '/admin/comments');

        $data = [
            "view" => "admin/pages/comments",
            "template" => "admin",
            "title" => "Tous les commentaires",
            "comments" => $pagination['items'],
            "pages" => $pagination['pages'],
            "currentPage" => $pagination['currentPage'],
            "buttons" => "comments"
        ];
        $this->generateView($data);
    }

    /**
     * La route pour modifier un commentaire
     * @param int $id
     * @return void
     */
    public function editComment(int $id)
    {
        $comment = CommentModel::getOneCommentById($id);

        $data = [
            "view" => "admin/pages/edit_comment",
            "template" => "admin",
            "title" => "Modification d'un commentaire",
            "comment" => $comment
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = htmlspecialchars($_POST['content']);

            if (CommentModel::updateComment($content, $comment->comment_id)) {
                Toolbox::flashMessage("success", "Commentaire modifié avec succès.");
                redirect('/admin/comments');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la suppression du commentaire.");
                redirect('/admin/comments');
            }

        }

        $this->generateView($data);
    }

    /**
     * La route pour supprimer un commentaire
     * @param int $id
     * @return void
     */
    public function deleteComment(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $comment = CommentModel::getOneCommentById($id);

            if (CommentModel::deleteComment($comment->comment_id)) {
                Toolbox::flashMessage("success", "Commentaire supprimé avec succès.");
                redirect('/admin/comments');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la suppression du commentaire.");
                redirect('/admin/comments');
            }

        } else {
            Toolbox::flashMessage("danger", "Méthode interdite.");
            redirect('/admin/comments');
        }
    }

    /**
     * La route des catégories
     * @return void
     */
    public function categories()
    {
        $categories = CategoryModel::getItems();

        $data = [
            "view" => "admin/pages/categories",
            "template" => "admin",
            "title" => "Liste des catégories",
            "categories" => $categories
        ];
        $this->generateView($data);
    }

    /**
     * La route pour modifier une catégorie
     * @param int $id
     * @return void
     */
    public function editCategory(int $id)
    {

        $category = CategoryModel::getOneCategory($id);

        $data = [
            "view" => "admin/pages/edit_category",
            "template" => "admin",
            "title" => "Modification d'une catégorie",
            "category" => $category
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);

            if (CategoryModel::updateCategoryName($name, $id)) {
                Toolbox::flashMessage("success", "Catégorie modifiée avec succès.");
                redirect('/admin/categories');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la suppression de la catégorie.");
                redirect('/admin/categories');
            }

        }

        $this->generateView($data);
    }

    /**
     * La fonction pour supprimer une catégorie
     * @param int $id
     * @return void
     */
    public function deleteCategory(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (CategoryModel::deleteCategory($id)) {
                Toolbox::flashMessage("success", "Catégorie supprimée avec succès.");
                redirect('/admin/categories');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la suppression de la catégorie.");
                redirect('/admin/categories');
            }

        } else {
            Toolbox::flashMessage("danger", "Méthode interdite.");
            redirect('/admin/categories');
        }
    }

    /**
     * La route pour ajouter une catégorie
     * @return void
     */
    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);

            if (CategoryModel::createCategory($name)) {
                Toolbox::flashMessage("success", "Catégorie créée avec succès.");
                redirect('/admin/categories');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la création de la catégorie.");
                redirect('/admin/categories');
            }

        }
    }
}