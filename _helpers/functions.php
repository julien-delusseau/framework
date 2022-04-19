<?php

use App\Models\CategoryModel;
use App\Models\PostsModel;

/**
 * Fonction pour chercher les catégories, ainsi que leur nombre par article
 * @return array|false
 */
function getCategories(): array|false
{
    return CategoryModel::getItems();
}

/**
 * Fonction pour chercher les derniers articles créés
 * @return array|false
 */
function getLatestPosts(): array|false
{
    return PostsModel::getLatestPosts(4);
}

/**
 * Fonction pour faire une redirection
 * @param string|null $path
 * @return void
 */
function redirect(?string $path = null)
{
    header("Location: " . URL . $path);
    exit;
}

/**
 * Fonction pour vérifier si un utilisateur est connecté
 * @return bool
 */
function isLoggedIn(): bool
{
    if (!isset($_SESSION['user'])) {
        return false;
    } else {
        return true;
    }
}

/**
 * Fonction pour vérifier le rôle de l'utilisateur
 * @param string $role
 * @return bool
 */
function isGranted(string $role): bool
{
    if (!isset($_SESSION['user'])) {
        return false;
    }

    if (in_array(strtoupper("role_$role"), $_SESSION['user']['role'])) {
        return true;
    }
    return false;
}