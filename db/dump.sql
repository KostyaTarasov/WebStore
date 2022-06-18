SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `catalog`;
CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpu_name_catalog` char(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Уникальный столбец name*/
ALTER TABLE `catalog` ADD UNIQUE(`name`);

INSERT INTO `catalog` (`id`, `cpu_name_catalog`, `name`, `text`, `content`) VALUES
(1, 'articles', 'Статьи', 'Дополнительное описание', ''),
(2, 'holodilniki', 'Холодильники', 'Дополнительное описание', 'holodilniki');
(3, 'chajniki', 'Чайники', 'Дополнительное описание', 'chajniki'),
(4, 'televizory', 'Телевизоры', 'Дополнительное описание', 'televizory'),
(5, 'naushniki', 'Наушники', 'Дополнительное описание', 'naushniki');
(6, 'popular-products', 'Популярные товары', 'Дополнительное описание', 'popular-products');

CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `email` varchar(255) NOT NULL,
    `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
    `role` enum('admin','user') NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    `auth_token` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 1, 'admin', 'hash1', 'token1', '2022-01-31 18:52:29'),
(2, 'user', 'user@gmail.com', 1, 'user', 'hash2', 'token2', '2021-02-31 18:52:29');


ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

CREATE TABLE `users_activation_codes` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users_activation_codes`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `users_activation_codes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `price`, `created_at`, `content`) VALUES
(1, 1, 'Статья о себе.', 'Текст статьи 5', NULL, '2022-01-31 18:52:51', ''),
(2, 1, 'Родился в городе Киров', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '');

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `news` (`id`, `name`, `text`, `created_at`, `content`) VALUES
(1, 'Заголовок новости 1', 'Текст новости 1', '2022-05-22 19:30:21', ''),
(2, 'Заголовок новости 2', 'Текст новости 2', '2022-05-22 19:32:21', '');

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `question` (`id`, `name`, `text`, `created_at`) VALUES
(1, 'Антон', 'Подскажите, какой срок доставки у данного товара?', '2022-05-22 19:30:21'),
(2, 'Василиса', 'Кто является производителем у товара?', '2022-05-22 19:30:21');

CREATE TABLE IF NOT EXISTS `popular_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `popular_products` (`id`, `author_id`, `name`, `text`, `price`, `created_at`, `content`) VALUES
(1, 1, 'Популярный товар 1', 'Информация о товаре', '66', '2022-05-22 19:30:21', ''),
(2, 1, 'Популярный товар 2', 'Информация о товаре', '77', '2022-05-22 19:30:21', '');

CREATE TABLE IF NOT EXISTS `holodilniki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `holodilniki` (`id`, `author_id`, `name`, `text`, `price`, `created_at`, `content`) VALUES
(1, 1, 'Статья о себе.', 'Текст статьи 5', NULL, '2022-01-31 18:52:51', ''),
(2, 1, 'Родился в городе Киров', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '');

CREATE TABLE IF NOT EXISTS `chajniki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `chajniki` (`id`, `author_id`, `name`, `text`, `price`, `created_at`, `content`) VALUES
(1, 1, 'Статья о себе.', 'Текст статьи 5', NULL, '2022-01-31 18:52:51', ''),
(2, 1, 'Родился в городе Киров', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '');

CREATE TABLE IF NOT EXISTS `televizory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `televizory` (`id`, `author_id`, `name`, `text`, `price`, `created_at`, `content`) VALUES
(1, 1, 'Статья о себе.', 'Текст статьи 5', NULL, '2022-01-31 18:52:51', ''),
(2, 1, 'Родился в городе Киров', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '');

CREATE TABLE IF NOT EXISTS `naushniki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `naushniki` (`id`, `author_id`, `name`, `text`, `price`, `created_at`, `content`) VALUES
(1, 1, 'Статья о себе.', 'Текст статьи 5', NULL, '2022-01-31 18:52:51', ''),
(2, 1, 'Родился в городе Киров', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '');

CREATE TABLE `orders` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_product` int(11) NOT NULL DEFAULT '0',
    `name_catalog` varchar(255) NOT NULL,
    `comment` text NOT NULL,
    `price` int(11) NOT NULL DEFAULT '0',
    `nickname` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `phone` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `orders` (`id`, `id_product`, `name_catalog`, `comment`, `price`, `nickname`, `email`, `phone`, `created_at`) VALUES
(1, '3', 'televizory', 'Тестовый комментарий клиента 1', '360', 'Павел Барабанов', 'user@gmail.com', '+7 999 999 99 99','2022-06-18 14:15:33'),
(2, '4', 'televizory', 'Тестовый комментарий клиента 2', '460', 'Иван Александрович', 'user@gmail.com', '+7 999 999 99 99','2022-06-18 14:15:33');