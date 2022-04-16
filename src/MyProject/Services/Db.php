<?php // Для соединения и работы с базой данных

namespace MyProject\Services;

use MyProject\Exception\DbException;


class Db
{
    private static $instance;

    /** @var \PDO */
    private $pdo;

    # Для того чтобы нельзя было в других местах кода создать новые объекты этого класса, стоит сделать конструктор private – тогда создать объект можно будет только с помощью метода getInstance() (Паттерн Singleton в PHP)
    private function __construct() // установим соединение с базой данных 1 раз

    {
        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
            // Свойство $this->pdo теперь можно использовать для работы с базой данных через PDO

        } catch (\PDOException $e) { // Теперь создадим «ловушки» для стандартных исключениий класса PDOException, и будем заменять их своими исключениями
            throw new \MyProject\Exceptions\DbException('Ошибка при подключении к базе данных: ' . $e->getMessage()); // Бросаем исключение, (на рабочем сайте не стоит писать лог ошибки в параметрах)
            //throw new \MyProject\Exceptions\DbException(); // Бросаем исключение ( пример без параметров)
        }
    }

    public static function getInstance(): self
    { // Проверять, что свойство $instance не равно null
        if (self::$instance === null) { // Если оно равно null, будет создан новый объект класса Db, а затем помещён в это свойство
            self::$instance = new self();
        }

        return self::$instance; // Вернёт значение этого свойства. Со второго вызова вместо создания нового объекта вернётся уже созданный ранее.
    }

    public function query(string $sql, $params = [], string $className = 'stdClass'): ?array // метод для выполнения запросов в базу, где третий параметр: Третьим аргументом в этот метод будет передаваться имя класса, объекты которого нужно создавать. По умолчанию это будут объекты класса stdClass – это такой встроенный класс в PHP, у которого нет никаких свойств и методов
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params); // Запускает подготовленный запрос на выполнение, где $params - массив значений, содержащий столько элементов, сколько параметров заявлено в SQL-запросе (value введённое пользователем).

        if (false === $result) {
            return null;
        }

        // return $sth->fetchAll();

        # для ORM
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className); // В метод fetchAll() мы передали специальную константу - \PDO::FETCH_CLASS, она говорит о том, что нужно вернуть результат в виде объектов какого-то класса. Второй аргумент – это имя класса, которое мы можем передать в метод query().
        // в результате мы получили массив объектов класса stdClass, у которых есть public-свойства, соответствующие именам столбцов в базе данных. В PHP мы можем задавать свойства объектов на лету, даже если они не были определены в классе. Это называется динамическим объявлением свойств. Если свойства у объекта нет, но мы попытаемся его задать – будет создано новое публичное свойство.


        // Второй способ через цикл, возвращает массив строк с необходимыми столбцами бд:
        /*       
        $i=0;
        while ($row=$sth->fetch()){
            $newsList[$i]['id']=$row['id'];
            $newsList[$i]['text']=$row['text'];
            $i++;
        }
        return $newsList;
        */
    }

    # чтобы получить id последней вставленной записи в базе (в рамках текущей сессии работы с БД)
    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}
