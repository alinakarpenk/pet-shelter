<?php

namespace core;

class Config
{
    protected $params;
    protected static $instance;
    private function __construct()
    {
        /** @var array $config */
        $directory = 'config';
        $conf_f = scandir($directory);
        foreach ($conf_f as $conf_fs){
            if (substr($conf_fs, -4) === '.php'){
                $path = $directory.'/'.$conf_fs;
                include ($path);
            }
        }
        $this->params=[];

        foreach ($config as $configs) {
            foreach ($configs as $key => $value){
                $this->$key = $value;
            }
        }

    }
    public static function get()
    {
        if (empty(self::$instance)) {
            self::$instance = new Config();
        }
        return self::$instance;
    }
    public function __set($name,$value)
    {
        $this->params[$name]=$value;
    }
    public function __get($name)
    {
       return $this->params[$name];
    }



}