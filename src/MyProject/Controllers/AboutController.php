<?php

namespace MyProject\Controllers;

use MyProject\Models\Informations\Informations;

class AboutController extends AbstractController
{
    public function action()
    {
        $this->view->renderHtml('/header.php', ['title' => 'О нас']);
        $this->view->renderHtml('/pages/about.php');
        $this->view->renderHtml('/rightSidebar.php');
    }

    public function edit(): void
    {
        $information = Informations::getById(1);

        if ($information === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для редактирования статьи нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $information->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('/pages/edit.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /about', true, 302);
            exit();
        }

        $this->view->renderHtml('/pages/edit.php');
    }
}
