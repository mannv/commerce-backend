CREATE DATABASE IF NOT EXISTS `db_web` COLLATE 'utf8mb4_unicode_ci';
GRANT ALL ON `db_web`.* TO 'default'@'%';

FLUSH PRIVILEGES;