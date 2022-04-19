<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\PostsModel;

class CommentController extends MainController
{
    /**
     * La route par défaut
     * @return void
     */
    public function index()
    {
        if (!isLoggedIn()) redirect('/user/login');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = htmlspecialchars($_POST['content']);
            $slug = htmlspecialchars($_POST['slug']);

            $post = PostsModel::getPostBySlug($slug);

            if ($post !== false) {
                if (CommentModel::createComment($content, $post->postID, $_SESSION['user']['id'])) {
                    Toolbox::flashMessage("success", "Commentaire créé avec succès.");
                    redirect('/' . $slug);
                } else {
                    Toolbox::flashMessage("danger", "Erreur lors de la création du commentaire.");
                    redirect('/' . $slug);
                }
            } else {
                Toolbox::flashMessage("danger", "Article introuvable.");
                redirect();
            }

        } else {
            Toolbox::flashMessage("danger", "Méthode interdite.");
            redirect();
        }
    }

    /**
     * La route pour mettre à jour des commentaires
     * @param $id
     * @return void
     */
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                redirect('/user/login');
            }

            $comment = CommentModel::getOneCommentById($id);
            $content = htmlspecialchars($_POST['content']);

            if ((isLoggedIn() && $_SESSION['user']['id'] === $comment->user_id) || isGranted('admin')) {
                if (CommentModel::updateComment($content, $comment->comment_id)) {
                    Toolbox::flashMessage("success", "Commentaire modifié avec succès.");
                    redirect('/' . $comment->slug);
                } else {
                    Toolbox::flashMessage("danger", "Erreur lors de la suppression du commentaire.");
                    redirect('/' . $comment->slug);
                }
            } else {
                Toolbox::flashMessage("danger", "Interdiction.");
                redirect();
            }

        } else {
            Toolbox::flashMessage("danger", "Méthode interdite.");
            redirect();
        }
    }

    /**
     * La route pour supprimer un commentaire
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                redirect('/user/login');
            }

            $comment = CommentModel::getOneCommentById($id);

            if ((isLoggedIn() && $_SESSION['user']['id'] === $comment->user_id) || isGranted('admin')) {
                if (CommentModel::deleteComment($comment->comment_id)) {
                    Toolbox::flashMessage("success", "Commentaire supprimé avec succès.");
                    redirect('/' . $comment->slug);
                } else {
                    Toolbox::flashMessage("danger", "Erreur lors de la suppression du commentaire.");
                    redirect('/' . $comment->slug);
                }
            } else {
                Toolbox::flashMessage("danger", "Interdiction.");
                redirect();
            }

        } else {
            Toolbox::flashMessage("danger", "Méthode interdite.");
            redirect();
        }
    }
}