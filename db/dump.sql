SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8;

DROP TABLE IF EXISTS `catalog`;
CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpu_name_catalog` char(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Уникальный столбец name*/
ALTER TABLE `catalog` ADD UNIQUE(`name`);

INSERT INTO `catalog` (`id`, `cpu_name_catalog`, `name`, `text`) VALUES
(1, 'articles', 'Статьи', 'Дополнительное описание'),
(2, 'holodilniki', 'Холодильники', 'Дополнительное описание'),
(3, 'televizory', 'Телевизоры', 'Дополнительное описание'),
(4, 'naushniki', 'Наушники', 'Дополнительное описание'),
(5, 'chajniki', 'Чайники', 'Дополнительное описание');
(20, 'popularnye_tovary', 'Популярные товары', 'Дополнительное описание'),

DROP TABLE IF EXISTS `common_information`;
CREATE TABLE IF NOT EXISTS `common_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `h1` text NOT NULL,
  `do` text NOT NULL,
  `do_info` text NOT NULL,
  `decription` text NOT NULL,
  `about_us` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `time_work` text NOT NULL,
  `mail` varchar(255) NOT NULL,
  `yandex_map` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

INSERT INTO `common_information` (`id`, `name`, `title`, `h1`, `do`, `do_info`, `decription`, `about_us`,`phone`, `address`, `time_work`, `mail`, `yandex_map`) VALUES
(1, 'Kirov Shop', 'Компания', 'Компания наша', 'Купить ', ' в Kirov Shop', 'Мы работаем', 'Профессионалы в этом деле', '+7 (123) 888-88-90', 'г. Киров, ул. Ленина, 1', 'ПН-ПТ: 10:00 - 18:00', 'test@yandex.ru', '');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_visible_login` tinyint(1) NOT NULL DEFAULT '1',
  `is_visible_author` tinyint(1) NOT NULL DEFAULT '1',
  `is_visible_buy` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`id`, `is_visible_login`, `is_visible_author`, `is_visible_buy`) VALUES
(1, 1, 1, 1);

CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `nickname` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
    `role` enum('admin','user') NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    `auth_token` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 1, 'admin', 'hash1', 'token1', '2022-01-31 18:52:29'),
(2, 'user', 'user@gmail.com', 1, 'user', 'hash2', 'token2', '2021-02-28 18:52:29');


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

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `author_id`, `name`, `text`, `price`, `created_at`, `content`, `catalog_id`, `is_popular`) VALUES
(1, 1, 'Статья о себе1.', 'Текст статьи 5', NULL, '2022-01-31 18:52:51', '', 1, 0),
(2, 1, 'Родился в городе Киров2', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 3, 1),
(3, 1, 'Статья о себе.3', 'Текст статьи 5', NULL, '2022-01-31 18:52:51', '', 1, 0),
(4, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 3, 0),
(5, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 4, 1),
(6, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 4, 1),
(7, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 2, 1),
(8, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 3, 0),
(9, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 3, 1),
(10, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 2, 0),
(11, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 1, 1),
(12, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 3, 0),
(13, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 4, 1),
(14, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 3, 0),
(15, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 1, 0),
(16, 1, 'Родился в городе Киров4', 'Текст статьи 6', NULL, '2022-01-31 18:52:51', '', 3, 0);

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