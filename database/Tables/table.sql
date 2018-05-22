/**
 * CreateTableArticle
 */
CREATE TABLE `articles`(
     `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
     `uniqueId` varchar(255) UNIQUE DEFAULT '',
     `entity_id` int(10) DEFAULT 0,
     `content` text,
     `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
     `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=innoDB DEFAULT CHARSET=utf8;

/**
 * CreateTableTag
 */
CREATE TABLE `tags`(
     `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
     `typeGroup` varchar(255),
     `type` varchar(255) DEFAULT '',
     `name` varchar(255),
     `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
     `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=innoDB DEFAULT CHARSET=utf8;

/**
 * CreateTablearticle_tags
 */
CREATE TABLE `article_tags`(
     `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
     `docId` varchar(255),
     `tagId` varchar(255),
     `score` int(3) DEFAULT 0,
     `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
     `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=innoDB DEFAULT CHARSET=utf8;

