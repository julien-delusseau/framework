<?php

namespace App\Controllers;

use App\Models\PostsModel;
use Ramsey\Uuid\Uuid;
use App\Models\UserModel;

class UserController extends MainController
{
    /**
     * La route de connexion
     * @return void
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $user = UserModel::searchUserByEmail($email);

            if ($user !== false) {
                if (password_verify($password, $user->password)) {
                    Toolbox::createSession($user);
                    redirect();
                } else {
                    Toolbox::flashMessage("danger", "Identifiants incorrects.");
                    redirect('/user/login');
                }
            } else {
                Toolbox::flashMessage("danger", "Identifiants incorrects.");
                redirect('/user/login');
            }
        }

        $data = [
            "view" => "user/login",
            "template" => "second_theme",
            "title" => "Se connecter"
        ];
        $this->generateView($data);
    }

    /**
     * La route pour s'enregistrer
     * @return void
     */
    public function register()
    {
        $data = [
            "view" => "user/register",
            "template" => "second_theme",
            "title" => "S'enregistrer",
            "email" => "",
            "firstname" => "",
            "lastname" => "",
            "emailError" => "",
            "firstnameError" => "",
            "lastnameError" => "",
            "passwordError" => "",
            "confirmError" => "",
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $uuid = Uuid::uuid4();

            $email = htmlspecialchars($_POST['email']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $role = htmlspecialchars($_POST['role']);

            if (empty($email)) {
                $data["emailError"] = "Merci de renseigner une adresse email";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data["emailError"] = "Adresse email non valide";
            } elseif (UserModel::searchUserByEmail($email)) {
                $data["emailError"] = "Adresse email déjà utilisée";
            }

            if (empty($firstname)) {
                $data["firstnameError"] = "Merci de renseigner votre prénom";
            }

            if (empty($lastname)) {
                $data["lastnameError"] = "Merci de renseigner votre nom";
            }

            if (empty($password)) {
                $data["passwordError"] = "Merci de renseigner un mot de passe";
            } elseif (strlen($password) < 6) {
                $data["passwordError"] = "6 caractères au minimum";
            }

            if (empty($confirm)) {
                $data["confirmError"] = "Merci de confirmer votre mot de passe";
            } elseif ($password !== $confirm) {
                $data["confirmError"] = "Les mots de passe ne correspondent pas";
            }

            if (!empty($data["emailError"]) || !empty($data["firstnameError"]) || !empty($data["lastnameError"]) || !empty($data["passwordError"]) || !empty($data["confirmError"])) {
                $data["firstname"] = $firstname;
                $data["lastname"] = $lastname;
                $data["email"] = $email;
                $this->generateView($data);
            }

            if ($role !== "ROLE_USER" && $role !== "ROLE_AUTHOR") {
                $role = "ROLE_USER";
            }

            if (UserModel::registerUser($firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $uuid->toString(), $role)) {
                $message = "
                <h2>Merci!</h2>
                <p>Un mail rapide pour vous remercier d'essayer ce Framework / CMS.</p>
                <p>Il reste beaucoup à faire pour l'améliorer, mais c'est déjà pas si mal.</p>
                <p>N'hésitez pas à le partager.</p>
                <p>Julien Delusseau</p>
                ";

                Toolbox::flashMessage("success", "Merci de votre enregistrement. Un email vient de vous être envoyé.");
                Toolbox::sendEmail($email, 'Bienvenue sur ce CMS', $message);
                redirect('/user/login');
            } else {
                dd("Problème lors de l'enregistrement");
            }
        }

        $this->generateView($data);
    }

    /**
     * La méthode pour se déconnecter
     * @return void
     */
    public function logout()
    {
        if (isLoggedIn()) {
            unset($_SESSION['user']);
            session_destroy();
            redirect('/user/login');
        }
    }

    /**
     * La route pour afficher le profil
     * @return void
     */
    public function profil()
    {
        if (!isLoggedIn()) {
            redirect('/user/login');
        }

        $articles = PostsModel::getPostsByAuthor($_SESSION['user']['id']);

        $data = [
            "view" => "user/profil",
            "template" => "second_theme",
            "title" => "Mon profil",
            "profil" => $_SESSION['user'],
            "articles" => $articles
        ];
        $this->generateView($data);
    }

    /**
     * La route pour mettre à jour l'utilisateur
     * @return void
     */
    public function update()
    {
        $data = [
            "view" => "user/update",
            "template" => "second_theme",
            "title" => "Modifier mon profil",
            "profil" => $_SESSION['user'],
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

            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            $email = htmlspecialchars($_POST['email']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $description = htmlspecialchars($_POST['description']);

            $user = UserModel::updateUser($id, $email, $firstname, $lastname, $description);

            if ($user !== false) {
                Toolbox::flashMessage("success", "Profil correctement mis à jour.");
                Toolbox::createSession($user);
                redirect('/user/profil');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la modification du profil.");
                redirect('/user/profil');
            }
        }

        $this->generateView($data);
    }

    /**
     * La route pour modifier le mot de passe
     * @return void
     */
    public function updatePassword()
    {
        $data = [
            "view" => "user/update_pass",
            "template" => "second_theme",
            "title" => "Modifier mon mot de passe",
            "passwordError" => "",
            "confirmError" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) redirect('user/login');

            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $email = $_SESSION['user']['email'];

            if (empty($password)) {
                $data["passwordError"] = "Merci de renseigner un mot de passe";
            } elseif (strlen($password) < 6) {
                $data["passwordError"] = "6 caractères au minimum";
            }

            if (empty($confirm)) {
                $data["confirmError"] = "Merci de confirmer votre mot de passe";
            } elseif ($password !== $confirm) {
                $data["confirmError"] = "Les mots de passe ne correspondent pas";
            }

            if (!empty($data["passwordError"]) || !empty($data["confirmError"])) {
                $this->generateView($data);
            }

            if (UserModel::updateUserPassword($email, password_hash($password, PASSWORD_DEFAULT))) {
                Toolbox::flashMessage("success", "Mot de passe correctement mis à jour.");
                redirect('/user/profil');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la modification du mot de passe.");
                redirect('/user/profil');
            }
        }

        $this->generateView($data);
    }

    /**
     * La route pour afficher un utilisateur
     * @param string $full_name
     * @return void
     */
    public function filter(string $full_name)
    {
        $fullname = explode('-', trim(htmlspecialchars($full_name)));
        $firstname = $fullname[0];
        $lastname = $fullname[1];

        $user = UserModel::searchUserByFullName($firstname, $lastname);
        $articles = PostsModel::getPostsByAuthor($user->id);

        if ($user) {
            $data = [
                "view" => "user/author",
                "template" => "second_theme",
                "title" => "Profil de $user->firstname $user->lastname",
                "profil" => $user,
                "articles" => $articles
            ];
            $this->generateView($data);
        } else {
            redirect();
        }

    }

    /**
     * La route pour mettre à jour l'avatar de l'utilisateur
     * @return void
     */
    public function updateImage()
    {
        if (!isLoggedIn()) redirect('/user/login');

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $uuid = Uuid::uuid4();

            // Le dossier où vont se placer nos images
            $targetDir = ROOT . '/public/assets/uploads/';

            // Le nom du fichier
            $filename = $uuid->toString() . '-' . $_FILES['image']['name'];

            // Le chemin complet avec nom et extension de l'image
            $targetFile = $targetDir . basename($filename);

            $uploadOk = 1;

            // Extension du fichier
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // On vérifie qu'il s'agisse bien d'une image
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check === false)
            {
                Toolbox::flashMessage("danger", "Ce n'est pas un fichier image.");
                redirect('/user/profil');
            }

            // On vérifie si le fichier existe déjà
            if (file_exists($targetFile)) {
                Toolbox::flashMessage("danger", "Ce fichier existe déjà.");
                redirect('/user/profil');
            }

            // On restreint la taille de l'image
            if ($_FILES['image']['size'] > 500000) {
                Toolbox::flashMessage("danger", "La taille de cette image est trop importante.");
                redirect('/user/profil');
            }

            // On limite l'accès à quelques extensions (jpg, jpeg, png, gif)
            if ($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png" && $imageFileType !== "gif") {
                Toolbox::flashMessage("danger", "Seules les extensions jpg, jpeg, png et gif sont acceptées.");
                redirect('/user/profil');
            }

            // On envoie notre fichier si tout est Ok
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                if (UserModel::uploadImage($filename, $_SESSION['user']['id'])) {
                    // Si l'utilisateur a déjà une image, on la supprime
                    if (!empty($_SESSION['user']['image'])) {
                        if (file_exists(ROOT . '/public/assets/uploads/' . $_SESSION['user']['image'])) {
                            unlink(ROOT . '/public/assets/uploads/' . $_SESSION['user']['image']);
                        }
                    }
                    $_SESSION['user']['image'] = $filename;
                    Toolbox::flashMessage("success", "Image importée avec succès.");
                    redirect('/user/profil');
                }
            } else {
                Toolbox::flashMessage("danger", "Une erreur est survenue lors de l'envoi de votre image.");
                redirect('/user/profil');
            }
        }

        $data = [
            "view" => "user/update_image",
            "template" => "second_theme",
            "title" => "Modifier mon image"
        ];
        $this->generateView($data);
    }

    /**
     * la méthode pour supprimer un utilisateur
     * @param $id
     * @return void
     */
    public function deleteUser($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = UserModel::searchUserById($id);
            $image = "";

            if($user) {
                if (!empty($user->image)) {
                    $image = $user->image;
                }

                if (UserModel::deleteUser($user->id)) {
                    unset($_SESSION["user"]);
                    session_destroy();
                    if (!empty($image)) {
                        unlink(ROOT . '/public/assets/uploads/' . $image);
                    }
                    Toolbox::flashMessage("success", "Utilisateur supprimé avec succès.");
                    redirect('/user/register');
                }
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la suppression de cet utilisateur.");
                redirect();
            }
        }
    }

    /**
     * La route pour les mots de passe oubliés
     * @return void
     */
    public function forgotPass()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $user = UserModel::searchUserByEmail($email);

            if ($user !== false) {
                $message = "
                <h2>Bonjour.</h2>
                <p>Vous avez demandé le reset de votre mot de passe.</p>
                <p>Merci de cliquer sur <a href='".URL."/user/resetpass/".$user->token."'>ce lien</a> afin de précéder au changement.</p>
                <p>L'administrateur de ce site</p>
                ";

                Toolbox::flashMessage("success", "Un email vient de vous être envoyé.");
                Toolbox::sendEmail($email, 'Modification de votre mot de passe', $message);
                redirect('/user/login');
            } else {
                Toolbox::flashMessage("success", "Un email vient de vous être envoyé.");
                redirect('/user/login');
            }
        }
        $data = [
            "view" => "user/forgot_pass",
            "template" => "second_theme",
            "title" => "Mot de passe oublié"
        ];
        $this->generateView($data);
    }

    /**
     * La route pour faire un reset du mot de passe
     * @param string $token
     * @return void
     */
    public function resetPass(string $token)
    {
        $data = [
            "view" => "user/reset_pass",
            "template" => "second_theme",
            "title" => "Reset du mot de passe",
            "passwordError" => "",
            "confirmError" => ""
        ];

        $user = UserModel::searchUserByToken($token);

        if (!$user) {
            Toolbox::flashMessage("danger", "Lien invalide.");
            redirect();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $user->email;
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];

            if (empty($password)) {
                $data["passwordError"] = "Merci de renseigner un mot de passe";
            } elseif (strlen($password) < 6) {
                $data["passwordError"] = "6 caractères au minimum";
            }

            if (empty($confirm)) {
                $data["confirmError"] = "Merci de confirmer votre mot de passe";
            } elseif ($password !== $confirm) {
                $data["confirmError"] = "Les mots de passe ne correspondent pas";
            }

            if (!empty($data["passwordError"]) || !empty($data["confirmError"])) {
                $this->generateView($data);
            }

            if (UserModel::updateUserPassword($email, password_hash($password, PASSWORD_DEFAULT))) {
                Toolbox::flashMessage("success", "Mot de passe mis à jour.");
                redirect('/user/login');
            } else {
                Toolbox::flashMessage("danger", "Erreur lors de la modification du mot de passe.");
                redirect('/user/login');
            }
        }

        $this->generateView($data);
    }
}