-- create database and after that:

CREATE TABLE `categories`(
    `id` INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `color` VARCHAR(7) NOT NULL
);

INSERT INTO `categories` (`id`,`name`,`color`) VALUES 
(1, 'study', '#42b6f5'),
(2, 'reading','#9631e8'),
(3, 'workout', '#cc2b36'),
(4, 'playing', '#2bcc6e');

CREATE TABLE `journey`(
    `id` INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(150) NOT NULL,
    `category_id` INT(5) NOT NULL,
    `hours` INT(3) NOT NULL,
    `date` DATE NOT NULL,
    `user_id` INT(11) NOT NULL
);

CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `hours` INT(3) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `name` varchar(100) NOT NULL
);

ALTER TABLE `journey`
ADD KEY `id_user_journey` (`user_id`),
ADD KEY `id_category_journey` (`category_id`);

ALTER TABLE `journey`
    ADD CONSTRAINT `id_user_journey` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
    ADD CONSTRAINT `id_category_journey` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

