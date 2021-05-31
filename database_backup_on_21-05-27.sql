

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('1','Ikea','ايكيا','a ver y good com[pany','adsfdsfdsf','4','','');

INSERT INTO packaging_companies (id, name_en, name_ar, details, image, stateId, created_at, updated_at) VALUES ('2','tawheed we el noor','التوحيد و النور','dfgdgfg dg','fgdfg','4','','');
