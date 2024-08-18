<?php

namespace core;

class Template
{
    protected $filePatch;
    protected $paramsArr;

    public function __construct($filePatch)
    {
        $this->filePatch = $filePatch;
        $this->paramsArr = [];
    }

    public function setParam($paramName, $paramValue)
    {
        $this->paramsArr[$paramName] = $paramValue;
    }

    public function setParams($params)
    {
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                $this->setParam($key, $value);
            }
        }
    }

    public function getHtml($patch = null, $params = [])
    {
        if (!empty($params)) {
            $this->setParams($params);
        }
        ob_start();
        extract($this->paramsArr);
        include($patch ? $patch : $this->filePatch);
        $string = ob_get_contents();
        ob_end_clean();
        return $string;
    }

    public function display()
    {
        echo $this->getHtml();
    }
}