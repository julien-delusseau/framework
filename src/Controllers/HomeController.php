<?php

namespace App\Controllers;

use App\Models\PostsModel;

class HomeController extends MainController
{
    public function index()
    {
        if (!empty(PostsModel::getCount()[0])) {
            $pagination = $this->pagination("PostsModel", 2);
        } else {
            $pagination = [
                "items" => [],
                "pages" => 0,
                "currentPage" => 1
            ];
        }

        $data = [
            "view" => "home/index",
            "template" => "second_theme",
            "title" => "Les derniers articles",
            "articles" => $pagination['items'],
            "pages" => $pagination['pages'],
            "currentPage" => $pagination['currentPage']
        ];
        $this->generateView($data);
    }
}