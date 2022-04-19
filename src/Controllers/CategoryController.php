<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\PostsModel;

class CategoryController extends MainController
{
    /**
     * La route pour afficher les articles par catégories
     * @param string $name
     * @return void
     */
    public function filter(string $name)
    {
        $posts = PostsModel::getPostsByCategoryName(filter_var($name, FILTER_SANITIZE_URL));

        $data = [
            "view" => "home/index",
            "template" => "second_theme",
            "title" => "Catégorie : " . ucwords(filter_var($name, FILTER_SANITIZE_URL)),
            "articles" => $posts
        ];
        $this->generateView($data);
    }
}