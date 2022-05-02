SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`, `content`) VALUES
(1, 1, 'Статья о себе.', 'Текст статьи 5', '2022-01-31 18:52:51', ''),
(2, 1, 'Родился в городе Киров', 'Текст статьи 6', '2022-01-31 18:52:51', '');

DROP TABLE IF EXISTS `catalog`;
CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_table` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `content` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

INSERT INTO `catalog` (`id`, `name_table`, `name`, `text`, `content`) VALUES
(1, 'articles', 'Статьи', 'Дополнительное описание', ''),
(2, 'holodilniki', 'Холодильники', 'Дополнительное описание', 'holodilniki');
(3, 'chajniki', 'Чайники', 'Дополнительное описание', 'chajniki'),
(4, 'televizory', 'Телевизоры', 'Дополнительное описание', 'televizory'),
(5, 'naushniki', 'Наушники', 'Дополнительное описание', 'naushniki');

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