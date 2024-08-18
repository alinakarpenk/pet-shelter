<?php

namespace core;

class Controller
{
    protected $template;
    public $Post = false;
    public $Get = false;


    public function __construct()
    {
        $action = Core::getInstance()->actionName;
        $module = Core::getInstance()->moduleName;
        $patch = "views/{$module}/{$action}.php" ;
        $this->template = new Template($patch);
        switch ($_SERVER['REQUEST_METHOD']){
            case 'POST':
                $this->Post=true;
                break;
            case 'GET' :
                $this->Get=true;
                break;
        }

    }
public function redirect($patch)
{
    header("Location: {$patch}");
    die;
}

}