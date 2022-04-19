<?php

namespace App\Controllers;

class ErrorController extends MainController
{
    public function index()
    {
        $data = [
            "view" => "error/404",
            "template" => "second_theme",
            "title" => "404 | Page introuvable"
        ];
        $this->generateView($data);
    }
}