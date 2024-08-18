<?php

namespace core;

class Session
{
    public function set($name,$value)
    {
        return $_SESSION[$name] = $value;
    }

    public function setV($sesArr)
    {
        foreach ($sesArr as $key => $value){
            $this->set($key,$value);
        }

    }
    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;

    }
    public function remove($name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

}