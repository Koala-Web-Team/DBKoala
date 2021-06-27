

CREATE TABLE `bad_words` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO categories (id, name_en, name_ar, image, type, created_at, updated_at) VALUES ('1','comic','كوميك','dfgdgfdgd','post','','');

INSERT INTO categories (id, name_en, name_ar, image, type, created_at, updated_at) VALUES ('2','sport','رياضة','fgdg','post','','');

INSERT INTO categories (id, name_en, name_ar, image, type, created_at, updated_at) VALUES ('3','laptops','لابات','mido.jpg','service','','');

INSERT INTO categories (id, name_en, name_ar, image, type, created_at, updated_at) VALUES ('4','cars','سيارات','mido.jpg','service','','');


CREATE TABLE `chat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contacts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_country_id_foreign` (`country_id`),
  CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_bin NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned DEFAULT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_comment_id_foreign` (`comment_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;


INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('1','gfhfhgfhg','4','17','','post','','');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('2','vnbvnbvn','3','17','1','post','','');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('3','fdggdfg','3','17','1','share','','');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('5','letgo','4','17','','post','2021-05-05 13:08:12','2021-05-05 13:08:12');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('6','letgo','4','17','','post','2021-05-05 13:08:53','2021-05-05 13:08:53');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('7','letgo','4','17','','post','2021-05-05 13:09:03','2021-05-05 13:09:03');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('8','letgo','4','17','','post','2021-05-05 13:09:43','2021-05-05 13:09:43');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('9','letgo','4','17','','post','2021-05-05 13:10:41','2021-05-05 13:10:41');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('10','letgo','4','17','','post','2021-05-05 13:11:24','2021-05-05 13:11:24');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('11','letgo','4','17','','post','2021-05-05 13:12:25','2021-05-05 13:12:25');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('12','letgo','4','17','','post','2021-05-05 15:12:01','2021-05-05 15:12:01');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('13','letgo','4','17','','post','2021-05-05 15:12:19','2021-05-05 15:12:19');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('14','letgo','4','17','','post','2021-05-05 15:12:53','2021-05-05 15:12:53');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('15','letgo','4','17','','post','2021-05-05 15:19:35','2021-05-05 15:19:35');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('16','letgo','4','17','','post','2021-05-05 15:57:59','2021-05-05 15:57:59');

INSERT INTO comments (id, body, user_id, model_id, comment_id, model_type, created_at, updated_at) VALUES ('17','letgo','4','17','','post','2021-05-05 17:29:54','2021-05-05 17:29:54');


CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `following` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `followerId` bigint(20) unsigned NOT NULL,
  `followingId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `following_followerid_foreign` (`followerId`),
  KEY `following_followingid_foreign` (`followingId`),
  CONSTRAINT `following_followerid_foreign` FOREIGN KEY (`followerId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `following_followingid_foreign` FOREIGN KEY (`followingId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `friendships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `senderId` bigint(20) unsigned NOT NULL,
  `receiverId` bigint(20) unsigned NOT NULL,
  `stateId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `friendships_senderid_foreign` (`senderId`),
  KEY `friendships_receiverid_foreign` (`receiverId`),
  KEY `friendships_stateid_foreign` (`stateId`),
  CONSTRAINT `friendships_receiverid_foreign` FOREIGN KEY (`receiverId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `friendships_senderid_foreign` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `friendships_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO friendships (id, senderId, receiverId, stateId, created_at, updated_at) VALUES ('1','3','4','2','','');

INSERT INTO friendships (id, senderId, receiverId, stateId, created_at, updated_at) VALUES ('2','4','5','2','','');

INSERT INTO friendships (id, senderId, receiverId, stateId, created_at, updated_at) VALUES ('3','6','4','2','','');


CREATE TABLE `group_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `group_id` bigint(20) unsigned NOT NULL,
  `stateId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_members_user_id_foreign` (`user_id`),
  KEY `group_members_group_id_foreign` (`group_id`),
  KEY `group_members_stateid_foreign` (`stateId`),
  CONSTRAINT `group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `group_members_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  CONSTRAINT `group_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO group_members (id, user_id, group_id, stateId, created_at, updated_at) VALUES ('4','3','2','2','','');

INSERT INTO group_members (id, user_id, group_id, stateId, created_at, updated_at) VALUES ('6','3','1','3','','');

INSERT INTO group_members (id, user_id, group_id, stateId, created_at, updated_at) VALUES ('7','4','2','2','','');


CREATE TABLE `groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy` smallint(5) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_category_id_foreign` (`category_id`),
  CONSTRAINT `groups_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO groups (id, name, profile_image, cover_image, description, privacy, category_id, created_at, updated_at) VALUES ('1','kh;k/;','fgfdg','1618922156_96825266_1504349436411104_1068335791614197760_n_.jpg','dfdsfd','1','1','','');

INSERT INTO groups (id, name, profile_image, cover_image, description, privacy, category_id, created_at, updated_at) VALUES ('2','hjhggjh','dfgfdgfd','1618922156_96825266_1504349436411104_1068335791614197760_n_.jpg','hgjhgj','0','2','','');


CREATE TABLE `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` smallint(5) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reactId` bigint(20) unsigned NOT NULL,
  `senderId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_reactid_foreign` (`reactId`),
  KEY `likes_senderid_foreign` (`senderId`),
  CONSTRAINT `likes_reactid_foreign` FOREIGN KEY (`reactId`) REFERENCES `reacts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_senderid_foreign` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO likes (id, model_id, model_type, reactId, senderId, created_at, updated_at) VALUES ('2','18','share','1','3','','');

INSERT INTO likes (id, model_id, model_type, reactId, senderId, created_at, updated_at) VALUES ('3','17','post','1','3','2021-05-06 00:45:05','2021-05-06 00:45:22');

INSERT INTO likes (id, model_id, model_type, reactId, senderId, created_at, updated_at) VALUES ('4','19','post','3','3','','');

INSERT INTO likes (id, model_id, model_type, reactId, senderId, created_at, updated_at) VALUES ('5','17','post','2','3','2021-05-07 23:50:47','2021-05-07 23:50:47');

INSERT INTO likes (id, model_id, model_type, reactId, senderId, created_at, updated_at) VALUES ('6','17','post','2','3','2021-05-07 23:51:36','2021-05-07 23:51:36');


CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mediaType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO media (id, filename, mediaType, model_type, model_id, created_at, updated_at) VALUES ('1','1619103504_1239931_824798544203865_817715241_n_.jpg','image','post','19','2021-04-22 14:58:24','2021-04-22 14:58:24');

INSERT INTO media (id, filename, mediaType, model_type, model_id, created_at, updated_at) VALUES ('2','1619103959_1239931_824798544203865_817715241_n_.jpg','image','post','19','2021-04-22 15:05:59','2021-04-22 15:05:59');

INSERT INTO media (id, filename, mediaType, model_type, model_id, created_at, updated_at) VALUES ('9','1620315940_1239931_824798544203865_817715241_n_.jpg','image','post','20','2021-05-06 15:45:40','2021-05-06 15:45:40');

INSERT INTO media (id, filename, mediaType, model_type, model_id, created_at, updated_at) VALUES ('10','1620315940_96825266_1504349436411104_1068335791614197760_n_.jpg','image','post','20','2021-05-06 15:45:40','2021-05-06 15:45:40');


CREATE TABLE `mention` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mentionTypeId` bigint(20) unsigned NOT NULL,
  `senderId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mention_mentiontypeid_foreign` (`mentionTypeId`),
  KEY `mention_senderid_foreign` (`senderId`),
  CONSTRAINT `mention_mentiontypeid_foreign` FOREIGN KEY (`mentionTypeId`) REFERENCES `mention_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mention_senderid_foreign` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `mention_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `chatId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_userid_foreign` (`userId`),
  KEY `messages_chatid_foreign` (`chatId`),
  CONSTRAINT `messages_chatid_foreign` FOREIGN KEY (`chatId`) REFERENCES `chat` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO migrations (id, migration, batch) VALUES ('1','0000_00_00_000000_create_websockets_statistics_entries_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('2','2019_08_19_000000_create_failed_jobs_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('3','2020_01_08_165911_create_categories_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('4','2020_03_12_0000001_create_groups_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('5','2020_03_12_215355_create_pages_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('6','2021_01_01_004830_create_sponsored_ages_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('7','2021_01_02_005657_create_countries_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('8','2021_01_03_005733_create_cities_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('9','2021_01_08_175327_create_states_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('10','2021_01_08_175328_create_users_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('11','2021_01_08_175329_create_user_categories_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('12','2021_01_08_175606_create_friendships_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('13','2021_01_08_180990_create_posts_types_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('14','2021_01_08_182416_create_sponsored_time_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('15','2021_01_08_182434_create_sponsored_reach_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('16','2021_01_08_184942_create_privacy_type_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('17','2021_01_08_184943_create_posts_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('18','2021_01_08_184944_create_media_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('19','2021_01_08_184946_create_sponsored_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('20','2021_01_08_190928_create_reacts_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('21','2021_01_08_190929_create_likes_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('22','2021_01_08_192155_create_sources_types_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('23','2021_01_08_192156_create_sources_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('24','2021_01_08_192157_create_mention_types_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('25','2021_01_08_192158_create_mention_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('26','2021_01_09_060332_create_bad_words_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('27','2021_01_09_060409_create_packaging_companies_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('28','2021_01_09_060731_create_packaging_companies_phones_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('29','2021_01_11_141649_create_permission_tables','1');

INSERT INTO migrations (id, migration, batch) VALUES ('30','2021_01_22_101420_create_reports_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('31','2021_02_04_195636_create_following_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('32','2021_02_16_021428_create_notifications_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('33','2021_02_16_221646_create_comments_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('34','2021_02_19_171651_create_chat_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('35','2021_02_19_171839_create_messages_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('36','2021_03_12_215426_creat_saved_posts_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('37','2021_03_13_111005_create_group_members_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('38','2021_03_13_193611_create_user_pages_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('39','2021_04_06_132341_create_password_resets_table','1');


CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('0acc3805-da80-418f-bc4d-da2eebaa13d7','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T15:12:01.000000Z","created_at":"2021-05-05T15:12:01.000000Z","id":12},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 15:12:01','2021-05-05 15:12:01');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('1535457a-851b-42be-b735-4965682e19ac','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T13:10:41.000000Z","created_at":"2021-05-05T13:10:41.000000Z","id":9},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 13:10:41','2021-05-05 13:10:41');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('48678d87-274c-4338-980a-f3b3e4de93fb','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T15:57:59.000000Z","created_at":"2021-05-05T15:57:59.000000Z","id":16},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 15:57:59','2021-05-05 15:57:59');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('4ca0cee9-19d7-4930-a311-779b48d8a284','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T15:12:53.000000Z","created_at":"2021-05-05T15:12:53.000000Z","id":14},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 15:12:53','2021-05-05 15:12:53');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('6c9a663c-6156-415e-a9c2-071de2da6a5d','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T15:19:35.000000Z","created_at":"2021-05-05T15:19:35.000000Z","id":15},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 15:19:35','2021-05-05 15:19:35');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('729b3f7d-636f-4aa1-850f-6a8f774ab5bf','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T13:11:24.000000Z","created_at":"2021-05-05T13:11:24.000000Z","id":10},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 13:11:24','2021-05-05 13:11:24');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('88dcd94d-452b-42d2-ac63-01d499c79537','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T13:12:25.000000Z","created_at":"2021-05-05T13:12:25.000000Z","id":11},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 13:12:25','2021-05-05 13:12:25');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('ede4121f-e157-476c-9fff-efc9d1f73974','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T17:29:54.000000Z","created_at":"2021-05-05T17:29:54.000000Z","id":17},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 17:29:55','2021-05-05 17:29:55');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('f83d6f01-54cd-472c-9ff3-333fb0b3792a','App\Notifications\CommentCreated','App\User','3','{"createdComment":{"body":"letgo","user_id":4,"model_id":17,"model_type":"post","updated_at":"2021-05-05T15:12:19.000000Z","created_at":"2021-05-05T15:12:19.000000Z","id":13},"user_commented":"mohamed","post_user":{"id":3,"name":"mid","email":"mohamedosama12w32@gmail.com","email_verified_at":"2021-05-02T11:07:30.000000Z","verification_code":"123456","birthDate":"2020-12-23","remember_token":null,"type":0,"phone":"01205232361","jobTitle":"developer","city":"alexandria","country":"egypt","gender":"male","personal_image":null,"cover_image":null,"stateId":null}}','','2021-05-05 15:12:19','2021-05-05 15:12:19');


CREATE TABLE `packaging_companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stateId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `packaging_companies_stateid_foreign` (`stateId`),
  CONSTRAINT `packaging_companies_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('1','Ikea','ايكيا','a very good company','ikea.jpg','4','','');

INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('4','Amcor','امكور','is a global leader in responsible global packaging solutions, supplying a broad range of rigid and flexible packaging products to the food, beverage, healthcare, home, personal care, and tobacco packaging industries. World-renowned innovation and customer','amcor.png','4','','');

INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('5','Ball
','بال','is a provider of metal packaging for beverages, foods, and household products, and of aerospace and other technologies and services to commercial and governmental customers. Founded in 1880, the company employs 15,000 people worldwide. Ball Corporation st','ball.jpg','5','','');

INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('6','Crown Holdings
','كراون','is one of the world’s top packaging companies for metal packaging technology. With operations in 40 countries, 23,000 employees, and net sales of $9.1 billion, the company is uniquely positioned to bring best practices in quality and manufacturing to grow','crown.jpg','4','','');

INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('7','International Paper
','International Paper
','is a leading global producer of packaging, paper, and pulp, with 55,000 employees operating in 24 countries. The company responsibly uses renewable resources to make recyclable products that millions of people depend on every day.','international.jpg','5','','');

INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('8','Mondi
','Mondi
','is an international packaging and paper group, employing around 25,000 people across more than 30 countries. Its key operations are located in central Europe, Russia, North America, and South Africa. Mondi is integrated across the packaging and paper valu','mondi.png','4','','');

INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('9','Owens-Illinois
','Owens-Illinois
','As the world’s leading glass container manufacturer, Owens-Illinois has more than a century of experience crafting pure, sustainable, brand-building glass packaging for many of the world’s best-known food and beverage brands. The company provides high-qua','owens.jpg','5','','');


CREATE TABLE `packaging_companies_phones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `packaging_company_id` bigint(20) unsigned NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `packaging_companies_phones_packaging_company_id_foreign` (`packaging_company_id`),
  CONSTRAINT `packaging_companies_phones_packaging_company_id_foreign` FOREIGN KEY (`packaging_company_id`) REFERENCES `packaging_companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO packaging_companies_phones (id, packaging_company_id, phoneNumber, created_at, updated_at) VALUES ('1','1','01205232369','','');

INSERT INTO packaging_companies_phones (id, packaging_company_id, phoneNumber, created_at, updated_at) VALUES ('2','1','01205232369','','');


CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_category_id_foreign` (`category_id`),
  CONSTRAINT `pages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO pages (id, name, profile_image, cover_image, description, category_id, created_at, updated_at) VALUES ('1','sfdsfdfdsf','dffdsf','picture.jpg','dfdfd','1','','');

INSERT INTO pages (id, name, profile_image, cover_image, description, category_id, created_at, updated_at) VALUES ('2','dsfdsfdffghgfh','dsfdfdgfh','picture.jpg','ssadbgfhfjhghj','2','','');


CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(15,5) unsigned DEFAULT NULL,
  `postTypeId` bigint(20) unsigned NOT NULL,
  `privacyId` bigint(20) unsigned NOT NULL,
  `stateId` bigint(20) unsigned NOT NULL,
  `publisherId` bigint(20) unsigned NOT NULL,
  `categoryId` bigint(20) unsigned NOT NULL,
  `group_id` bigint(20) unsigned DEFAULT NULL,
  `page_id` bigint(20) unsigned DEFAULT NULL,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_posttypeid_foreign` (`postTypeId`),
  KEY `posts_privacyid_foreign` (`privacyId`),
  KEY `posts_stateid_foreign` (`stateId`),
  KEY `posts_publisherid_foreign` (`publisherId`),
  KEY `posts_categoryid_foreign` (`categoryId`),
  KEY `posts_group_id_foreign` (`group_id`),
  KEY `posts_page_id_foreign` (`page_id`),
  KEY `posts_post_id_foreign` (`post_id`),
  CONSTRAINT `posts_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_posttypeid_foreign` FOREIGN KEY (`postTypeId`) REFERENCES `posts_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_privacyid_foreign` FOREIGN KEY (`privacyId`) REFERENCES `privacy_type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_publisherid_foreign` FOREIGN KEY (`publisherId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO posts (id, body, price, postTypeId, privacyId, stateId, publisherId, categoryId, group_id, page_id, post_id, created_at, updated_at) VALUES ('16','cvbvvcbvb','200','1','1','2','3','3','','','','','');

INSERT INTO posts (id, body, price, postTypeId, privacyId, stateId, publisherId, categoryId, group_id, page_id, post_id, created_at, updated_at) VALUES ('18','fdfghfhfh','300','1','1','2','3','1','','','','','');

INSERT INTO posts (id, body, price, postTypeId, privacyId, stateId, publisherId, categoryId, group_id, page_id, post_id, created_at, updated_at) VALUES ('19','vvbnbvnbvn','','2','1','2','4','2','','','','','');

INSERT INTO posts (id, body, price, postTypeId, privacyId, stateId, publisherId, categoryId, group_id, page_id, post_id, created_at, updated_at) VALUES ('20','ممكن ابيع ده دلوقتي','','2','1','2','3','1','','','','2021-05-06 15:45:39','2021-05-06 15:45:39');

INSERT INTO posts (id, body, price, postTypeId, privacyId, stateId, publisherId, categoryId, group_id, page_id, post_id, created_at, updated_at) VALUES ('21','ممكن ابيع ده دلوقتي','','1','1','2','3','1','','','','2021-05-06 15:47:38','2021-05-06 15:47:38');

INSERT INTO posts (id, body, price, postTypeId, privacyId, stateId, publisherId, categoryId, group_id, page_id, post_id, created_at, updated_at) VALUES ('22','wwewe','12.45435','1','2','2','3','2','','','','2021-05-06 15:49:19','2021-05-07 12:26:13');


CREATE TABLE `posts_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO posts_types (id, name_en, name_ar, created_at, updated_at) VALUES ('1','service','خدمة','','');

INSERT INTO posts_types (id, name_en, name_ar, created_at, updated_at) VALUES ('2','post','منشور','','');


CREATE TABLE `privacy_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO privacy_type (id, name_en, name_ar, created_at, updated_at) VALUES ('1','public','عام','','');

INSERT INTO privacy_type (id, name_en, name_ar, created_at, updated_at) VALUES ('2','private','خاص','','');


CREATE TABLE `reacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO reacts (id, name, image, created_at, updated_at) VALUES ('1','sad','fgfgfd','','');

INSERT INTO reacts (id, name, image, created_at, updated_at) VALUES ('2','happy','fgfg','','');

INSERT INTO reacts (id, name, image, created_at, updated_at) VALUES ('3','care','fgfdg','','');


CREATE TABLE `reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stateId` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_stateid_foreign` (`stateId`),
  CONSTRAINT `reports_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `saved_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `saved_posts_user_id_foreign` (`user_id`),
  KEY `saved_posts_post_id_foreign` (`post_id`),
  CONSTRAINT `saved_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `saved_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sourceId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sourceTypeId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sources_sourcetypeid_foreign` (`sourceTypeId`),
  CONSTRAINT `sources_sourcetypeid_foreign` FOREIGN KEY (`sourceTypeId`) REFERENCES `sources_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `sources_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `sponsored` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `timeId` bigint(20) unsigned NOT NULL,
  `reachId` bigint(20) unsigned NOT NULL,
  `postId` bigint(20) unsigned NOT NULL,
  `stateId` bigint(20) unsigned NOT NULL,
  `age_id` bigint(20) unsigned NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `city_id` bigint(20) unsigned NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sponsored_timeid_foreign` (`timeId`),
  KEY `sponsored_reachid_foreign` (`reachId`),
  KEY `sponsored_postid_foreign` (`postId`),
  KEY `sponsored_stateid_foreign` (`stateId`),
  KEY `sponsored_age_id_foreign` (`age_id`),
  KEY `sponsored_country_id_foreign` (`country_id`),
  KEY `sponsored_city_id_foreign` (`city_id`),
  CONSTRAINT `sponsored_age_id_foreign` FOREIGN KEY (`age_id`) REFERENCES `sponsored_ages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sponsored_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sponsored_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sponsored_postid_foreign` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sponsored_reachid_foreign` FOREIGN KEY (`reachId`) REFERENCES `sponsored_reach` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sponsored_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sponsored_timeid_foreign` FOREIGN KEY (`timeId`) REFERENCES `sponsored_time` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `sponsored_ages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `sponsored_reach` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reach` int(10) unsigned NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `sponsored_time` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `states` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO states (id, name) VALUES ('1','unapproved');

INSERT INTO states (id, name) VALUES ('2','approved');

INSERT INTO states (id, name) VALUES ('3','pending');

INSERT INTO states (id, name) VALUES ('4','active');

INSERT INTO states (id, name) VALUES ('5','inactive');


CREATE TABLE `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(255) NOT NULL,
  `privacyId` int(11) NOT NULL,
  `publisherId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `privacyId` (`privacyId`),
  KEY `publisherId` (`publisherId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `user_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categoryId` bigint(20) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_categories_categoryid_foreign` (`categoryId`),
  KEY `user_categories_userid_foreign` (`userId`),
  CONSTRAINT `user_categories_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_categories_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO user_categories (id, categoryId, userId, created_at, updated_at) VALUES ('1','1','3','','');

INSERT INTO user_categories (id, categoryId, userId, created_at, updated_at) VALUES ('2','2','3','','');


CREATE TABLE `user_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `page_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_pages_user_id_foreign` (`user_id`),
  KEY `user_pages_page_id_foreign` (`page_id`),
  CONSTRAINT `user_pages_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO user_pages (id, user_id, page_id, created_at, updated_at) VALUES ('4','3','2','','');

INSERT INTO user_pages (id, user_id, page_id, created_at, updated_at) VALUES ('5','4','1','','');


CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `remember_token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` smallint(5) unsigned NOT NULL DEFAULT 0,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jobTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stateId` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_stateid_foreign` (`stateId`),
  CONSTRAINT `users_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO users (id, name, email, email_verified_at, password, verification_code, birthDate, remember_token, type, phone, jobTitle, city, country, gender, personal_image, cover_image, stateId) VALUES ('3','mohamed','mohamedosama12w32@gmail.com','2021-05-02 11:07:30','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','123456','2020-12-23','','0','01205232369','developer','alexandria','egypt','male','','','');

INSERT INTO users (id, name, email, email_verified_at, password, verification_code, birthDate, remember_token, type, phone, jobTitle, city, country, gender, personal_image, cover_image, stateId) VALUES ('4','mohamed','mohamedsf@gmail.com','','dsfdsfds','dfdsf','2021-04-08','dfdsfsd','0','01205232368','dfsf','dfdsf','dfsf','dfss','','dsfdsf','');

INSERT INTO users (id, name, email, email_verified_at, password, verification_code, birthDate, remember_token, type, phone, jobTitle, city, country, gender, personal_image, cover_image, stateId) VALUES ('5','mohamed','ahmed@gmail.com','','fsdfdfdsfdf','dfsfdsf','2021-05-20','dfdsf','0','01205232368','dsfdsf','dfdsf','dsfsdf','dsfdf','dfsdf','dfdsf','');

INSERT INTO users (id, name, email, email_verified_at, password, verification_code, birthDate, remember_token, type, phone, jobTitle, city, country, gender, personal_image, cover_image, stateId) VALUES ('6','mizo','dfsd@gmail.com','','fgdg','fgfg','2021-05-20','fgfdg','0','012434543584','fgdgf','fdgdg','fgdg','fdgdg','fgfdg','fgdg','');


CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

