<?php

namespace App;

class Router
{
    public function __construct()
    {
        $url = $this->getURL();
        $controller = 'home';
        $method = "index";
        $params = [];

        if (file_exists(ROOT . '/src/Controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $controller = ucwords($url[0]);
            unset($url[0]);
        } else {
            $controller = "Post";
        }

        $namespace = "App\Controllers\\" . $controller . 'Controller';
        $controller = new $namespace();

        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($controller, $url[1])) {
                $method = $url[1];
                unset($url[1]);
            } else {
                redirect('/error');
            }
        }

        $params = empty($url) ? [] : array_values($url);

        call_user_func_array([$controller, $method], $params);
    }

    /**
     * @return string[]
     */
    private function getURL(): array
    {
        if (isset($_GET['url']) && !empty($_GET['url'])) {
            return explode('/', trim(filter_var($_GET['url'], FILTER_SANITIZE_URL), '/'));
        }
        return ['home'];
    }
}