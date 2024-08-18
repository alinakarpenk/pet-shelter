<?php

namespace core;

class Router
{
    protected $page;
    public function __construct($route)
    {
        $this->page = $route;
    }

    public function splitURL()
    {
        $parts = explode('/', $this->page);
        if (strlen($parts[0]) == 0) {
            $parts[0] = 'main';
            $parts[1] = 'page';
        }
        if (count($parts) == 1)
            $parts[1] = 'page';

        \core\Core::getInstance()->moduleName = $parts[0];
        \core\Core::getInstance()->actionName = $parts[1];
        $controller_name = 'controllers\\' . ucfirst($parts[0]) . 'Controller';
        $method_name = 'action' . ucfirst($parts[1]);
        if (class_exists($controller_name)) {
            $class = new $controller_name;
            if (method_exists($controller_name, $method_name)) {
                $params = array_slice($parts, 2); // Обрізаємо перші дві частини (модуль і дію)
                return $class->$method_name($params); // Передаємо параметри як масив
            } else {
                $this->show404();
                return [];
            }
        } else {
            $this->show404();
            return [];
        }
    }


    protected function show404()
    {
        header('HTTP/1.1 404 Not Found');
        \core\Core::getInstance()->template->setParam('Title', '404');
        \core\Core::getInstance()->template->setParam('Content', file_get_contents('views/404/404.php'));
    }
}
