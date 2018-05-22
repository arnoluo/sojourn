/**
 * CreateTableArticle
 */
CREATE TABLE `articles`(
     `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
     `type` varchar(64) DEFAULT 'text',
     `title` varchar(64),
     `content` text,
     `status` boolean DEFAULT 1,
     `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
     `updated_at` timestamp
) ENGINE=innoDB DEFAULT CHARSET=utf8;

/**
 * CreateTableUser
 */
CREATE TABLE `users`(
     `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
     `name` varchar(32) UNIQUE,
     `password` varchar(255),
     `token` varchar(255),
     `status` boolean DEFAULT 1,
     `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
     `updated_at` timestamp
) ENGINE=innoDB DEFAULT CHARSET=utf8;

