<?php

namespace core;

use models\User;



class Core
{
    public $patch = 'views/layout/index.php';
    public $moduleName;
    public $actionName;
    public $router;
    public $template;
    public $session;
    private static $instance;

    private function __construct()
    {
        $this->template = new Template($this->patch);
        $this->session = new Session();
        session_start();
    }

    public function splitUrl($page)
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $this->router = new Router($page);
        $params = $this->router->splitURL();
        $this->template->setParams($params);
        if ($url[1] === 'news' && $url[2] === 'add') {
            $user = new User();
            if (!$user->isAdmin()) {
                header('Location: /news');
                exit;
            }
        }
    }

    public function done()
    {
        if (!headers_sent()) {
            $this->template->display();
        }
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Core();
        }
        return self::$instance;
    }
}
