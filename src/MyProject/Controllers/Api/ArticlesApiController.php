<?php
# контроллер позволит работать со статьями через API
namespace MyProject\Controllers\Api;

use MyProject\Controllers\AbstractController;
use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;

class ArticlesApiController extends AbstractController
{
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $this->view->displayJson([
            'articles' => [$article]
        ]);
    }


    /*
 Изменить статью с помощью API. Для этого нам нужно отправить в API запрос в формате JSON.
php://input – это входной поток данных. Именно из него мы и будем получать JSON из запроса. 
file_get_contents – читает данные из указанного места, в нашем случае из входного потока. 
json_decode декодирует json в структуру массива.
Используя Postman отправим запрос: Post, адрес http://learnphp/www/api/articles/add, в Body raw пишем:
{
"articles": [
{
"name": "Postman запрос",
"text": "Проверка добавления статьи",
"author_id": "1"
}
]
}
Далее жмём кнопку Send. Выбираем вкладку Preview и получаем массив
Просмотр статьи http://learnphp/www/api/articles/1
*/
    public function add()
    {
        $input = $this->getInputData();
        $articleFromRequest = $input['articles'][0];

        $authorId = $articleFromRequest['author_id'];
        $author = User::getById($authorId);

        $article = Article::createFromArray($articleFromRequest, $author);
        $article->save();

        header('Location: /www/api/articles/' . $article->getId(), true, 302);
    }

    //* REST API это:
    /*
    1.) Запрос и ответ имеют одинаковую структуру: посмотреть статью в формате JSON. (Чтобы обновить её – мы тоже отправляем статью в формате JSON, с теми же полями.)
    2.) Используются разные типы запросов (GET, POST, PUT, DELETE и другие).
    3.) Используется формат, с которым удобно работать другим программам (чаще всего JSON, но могут быть и другие – например, XML).
    */
}
