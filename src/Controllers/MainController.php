<?php
namespace App\Controllers;


class MainController
{
    /**
     * La méthode pour générer une vue
     * @param array $data
     * @return void
     */
    protected function generateView(array $data): void
    {
        extract($data);
        ob_start();
        require_once ROOT . '/views/'.$view.'.php';
        $pageContent = ob_get_clean();
        require_once ROOT . '/views/templates/'.$template.'.php';
        exit;
    }

    /**
     * Méthode pour faire une pagination
     * @param mixed $modelName
     * @param int $limit
     * @return array
     */
    protected function pagination(mixed $modelName, int $limit): array
    {
        $page = $_GET['page'] ?? 1;
        if (!filter_var($page, FILTER_VALIDATE_INT)) redirect();
        if ($page === "1") redirect();

        $currentPage = (int)$page;

        if ($currentPage <= 0) redirect();

        $model = "App\Models\\" . $modelName;
        $count = $model::getCount()[0] ?? 0;

        $nbPages = ceil($count / $limit);
        $offset = ($currentPage - 1) * $limit;

        if ($currentPage > $nbPages || $currentPage < 1) redirect();

        $items = $model::getItems($limit, $offset) ?? [];

        return [
            "items" => $items,
            "pages" => $nbPages,
            "currentPage" => $currentPage
        ];
    }

    /**
     * Méthode pour faire une pagination côté admin
     * @param mixed $modelName
     * @param int $limit
     * @return array
     */
    protected function adminPagination(mixed $modelName, int $limit, string $redirect): array
    {
        $page = $_GET['page'] ?? 1;
        if (!filter_var($page, FILTER_VALIDATE_INT)) redirect($redirect);
        if ($page === "1") redirect($redirect);

        $currentPage = (int)$page;

        if ($currentPage <= 0) redirect($redirect);

        $model = "App\Models\\" . $modelName;
        $count = $model::getCount()[0];

        $nbPages = ceil($count / $limit);
        $offset = ($currentPage - 1) * $limit;

        if ($currentPage > $nbPages || $currentPage < 1) redirect($redirect);

        $items = $model::getItems($limit, $offset);

        return [
            "items" => $items,
            "pages" => $nbPages,
            "currentPage" => $currentPage
        ];
    }
}