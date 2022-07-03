<?php

namespace MyProject\Controllers;

class СontactController extends AbstractController
{
    public function contact()
    {
        $this->view->renderHtml('/header.php');
        $this->view->renderHtml('/pages/contact.php');
        $this->view->renderHtml('/rightSidebar.php');
    }
}
