<?php

namespace MyProject\Controllers;

class AboutController extends AbstractController
{
    public function action()
    {
        $this->view->renderHtml('/header.php', ['title' => 'О нас']);
        $this->view->renderHtml('/pages/about.php');
        $this->view->renderHtml('/rightSidebar.php');
    }
}
