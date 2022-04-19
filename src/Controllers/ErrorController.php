<?php

namespace App\Controllers;

class ErrorController extends MainController
{
    /**
     * La route par défaut
     * @return void
     */
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