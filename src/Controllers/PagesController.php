<?php
namespace App\Controllers;

class PagesController extends MainController
{

    public function contact()
    {
        $data = [
            "view" => "contact/contact",
            "template" => "second_theme",
            "title" => "Me contacter",
            "email" => "",
            "name" => "",
            "subject" => "",
            "message" => "",
            "emailError" => "",
            "nameError" => "",
            "subjectError" => "",
            "messageError" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = htmlspecialchars($_POST['email']);
            $name = htmlspecialchars($_POST['name']);
            $subject = htmlspecialchars($_POST['subject']);
            $message = $_POST['message'];

            if (empty($email)) {
                $data["emailError"] = "Merci de renseigner une adresse email";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data["emailError"] = "Adresse email non valide";
            }

            if (empty($name)) {
                $data["nameError"] = "Merci de renseigner votre nom";
            }

            if (empty($subject)) {
                $data["subjectError"] = "Merci de renseigner le sujet";
            }

            if (empty($message)) {
                $data["messageError"] = "Merci de renseigner votre message";
            } elseif (strlen($message) < 20) {
                $data["messageError"] = "20 caractères au minimum";
            }

            if (!empty($data["emailError"]) || !empty($data["nameError"]) || !empty($data["subjectError"]) || !empty($data["messageError"])) {
                $data["name"] = $name;
                $data["subject"] = $subject;
                $data["email"] = $email;
                $data["message"] = $message;
                $this->generateView($data);
            }

            Toolbox::flashMessage("success", "Merci de votre message. Nous vous contacterons dans les plus brefs délais.");
            $emailMessage = "
            <p>Nouveau message de $name</p>
            <p>".nl2br($message)."</p>
            ";
            Toolbox::sendEmail($email, EMAIL, $subject, $emailMessage);
            redirect('/pages/contact');
        }

        $this->generateView($data);
    }
}