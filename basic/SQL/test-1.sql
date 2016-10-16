CREATE DATABASE `starkkraft_test`;
USE `starkkraft_test`;

-- таблица новостей
CREATE TABLE `article` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `date_created` DATETIME NOT NULL,
  `theme_id` INT(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  COMMENT 'таблица новостей';

-- таблица тем для новостей
CREATE TABLE `theme` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `date_created` DATETIME NOT NULL,
  `article_cnt` INT(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  COMMENT 'таблица тем для новостей';

INSERT INTO `theme` VALUES (1, 'путешествия', NOW(), 0);
INSERT INTO `theme` VALUES (2, 'отдых', NOW(), 0);
INSERT INTO `theme` VALUES (3, 'развлечения', NOW(), 0);
INSERT INTO `theme` VALUES (4, 'работа', NOW(), 0);
INSERT INTO `theme` VALUES (5, 'досуг', NOW(), 0);
INSERT INTO `theme` VALUES (6, 'школа', NOW(), 0);
INSERT INTO `theme` VALUES (7, 'хобби', NOW(), 0);