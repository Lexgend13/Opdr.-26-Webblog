CREATE TABLE `Articles` (
  `id` int PRIMARY KEY,
  `title` varchar(255),
  `body` varchar(255),
  `author_id` varchar(255),
  `image` varchar(255),
  `is_premium` bool,
  `created_at` datetime,
  `updated_at` datetime
);

CREATE TABLE `Comments` (
  `id` int PRIMARY KEY,
  `user_id` varchar(255),
  `body` varchar(255),
  `created_at` datetime,
  `updated_at` datetime,
  `article_id` int
);

CREATE TABLE `Categories` (
  `id` int PRIMARY KEY,
  `name` varchar(255)
);

CREATE TABLE `ArticleCategory` (
  `article_id` int,
  `category_id` int
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY,
  `name` varchar(255),
  `username` varchar(255),
  `email` varchar(255) UNIQUE,
  `email_verified_at` datetime,
  `password` varchar(255),
  `has_premium` bool,
  `created_at` datetime,
  `updated_at` datetime
);

ALTER TABLE `Articles` ADD FOREIGN KEY (`id`) REFERENCES `Comments` (`article_id`);

ALTER TABLE `ArticleCategory` ADD FOREIGN KEY (`article_id`) REFERENCES `Articles` (`id`);

ALTER TABLE `ArticleCategory` ADD FOREIGN KEY (`category_id`) REFERENCES `Categories` (`id`);

ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `Articles` (`author_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `Comments` (`user_id`);
