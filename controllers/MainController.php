<?php

namespace controllers;

use core\Controller;

class MainController extends Controller
{
   public function actionPage()
   {
       return [
           'Content' => $this->template->getHtml(),
           'Title'=>"Main Page"
       ];
   }
}