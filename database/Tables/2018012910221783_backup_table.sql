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
     `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=innoDB DEFAULT CHARSET=utf8;

