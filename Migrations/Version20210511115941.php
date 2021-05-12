<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511115941 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groups DROP FOREIGN KEY groups_category_id_foreign');
        $this->addSql('ALTER TABLE pages DROP FOREIGN KEY pages_category_id_foreign');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_categoryid_foreign');
        $this->addSql('ALTER TABLE user_categories DROP FOREIGN KEY user_categories_categoryid_foreign');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY messages_chatid_foreign');
        $this->addSql('ALTER TABLE sponsored DROP FOREIGN KEY sponsored_city_id_foreign');
        $this->addSql('ALTER TABLE cities DROP FOREIGN KEY cities_country_id_foreign');
        $this->addSql('ALTER TABLE sponsored DROP FOREIGN KEY sponsored_country_id_foreign');
        $this->addSql('ALTER TABLE group_members DROP FOREIGN KEY group_members_group_id_foreign');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_group_id_foreign');
        $this->addSql('ALTER TABLE mention DROP FOREIGN KEY mention_mentiontypeid_foreign');
        $this->addSql('ALTER TABLE packaging_companies_phones DROP FOREIGN KEY packaging_companies_phones_packaging_company_id_foreign');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_page_id_foreign');
        $this->addSql('ALTER TABLE user_pages DROP FOREIGN KEY user_pages_page_id_foreign');
        $this->addSql('ALTER TABLE model_has_permissions DROP FOREIGN KEY model_has_permissions_permission_id_foreign');
        $this->addSql('ALTER TABLE role_has_permissions DROP FOREIGN KEY role_has_permissions_permission_id_foreign');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_posttypeid_foreign');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_privacyid_foreign');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY likes_reactid_foreign');
        $this->addSql('ALTER TABLE model_has_roles DROP FOREIGN KEY model_has_roles_role_id_foreign');
        $this->addSql('ALTER TABLE role_has_permissions DROP FOREIGN KEY role_has_permissions_role_id_foreign');
        $this->addSql('ALTER TABLE sources DROP FOREIGN KEY sources_sourcetypeid_foreign');
        $this->addSql('ALTER TABLE sponsored DROP FOREIGN KEY sponsored_age_id_foreign');
        $this->addSql('ALTER TABLE sponsored DROP FOREIGN KEY sponsored_reachid_foreign');
        $this->addSql('ALTER TABLE sponsored DROP FOREIGN KEY sponsored_timeid_foreign');
        $this->addSql('ALTER TABLE friendships DROP FOREIGN KEY friendships_stateid_foreign');
        $this->addSql('ALTER TABLE group_members DROP FOREIGN KEY group_members_stateid_foreign');
        $this->addSql('ALTER TABLE packaging_companies DROP FOREIGN KEY packaging_companies_stateid_foreign');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_stateid_foreign');
        $this->addSql('ALTER TABLE reports DROP FOREIGN KEY reports_stateid_foreign');
        $this->addSql('ALTER TABLE sponsored DROP FOREIGN KEY sponsored_stateid_foreign');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY users_stateid_foreign');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY comments_user_id_foreign');
        $this->addSql('ALTER TABLE following DROP FOREIGN KEY following_followerid_foreign');
        $this->addSql('ALTER TABLE following DROP FOREIGN KEY following_followingid_foreign');
        $this->addSql('ALTER TABLE friendships DROP FOREIGN KEY friendships_receiverid_foreign');
        $this->addSql('ALTER TABLE friendships DROP FOREIGN KEY friendships_senderid_foreign');
        $this->addSql('ALTER TABLE group_members DROP FOREIGN KEY group_members_user_id_foreign');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY likes_senderid_foreign');
        $this->addSql('ALTER TABLE mention DROP FOREIGN KEY mention_senderid_foreign');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY messages_userid_foreign');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_publisherid_foreign');
        $this->addSql('ALTER TABLE saved_posts DROP FOREIGN KEY saved_posts_user_id_foreign');
        $this->addSql('ALTER TABLE user_categories DROP FOREIGN KEY user_categories_userid_foreign');
        $this->addSql('ALTER TABLE user_pages DROP FOREIGN KEY user_pages_user_id_foreign');
        $this->addSql('CREATE TABLE articale (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, content LONGTEXT DEFAULT NULL, publish_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE osama (id INT AUTO_INCREMENT NOT NULL, fname VARCHAR(255) DEFAULT NULL, lname VARCHAR(255) DEFAULT NULL, phone LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, fname VARCHAR(255) NOT NULL, lname VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(250) DEFAULT NULL, no VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE bad_words');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE failed_jobs');
        $this->addSql('DROP TABLE following');
        $this->addSql('DROP TABLE friendships');
        $this->addSql('DROP TABLE group_members');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE likes');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE mention');
        $this->addSql('DROP TABLE mention_types');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE migrations');
        $this->addSql('DROP TABLE model_has_permissions');
        $this->addSql('DROP TABLE model_has_roles');
        $this->addSql('DROP TABLE notifications');
        $this->addSql('DROP TABLE packaging_companies');
        $this->addSql('DROP TABLE packaging_companies_phones');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE password_resets');
        $this->addSql('DROP TABLE permissions');
        $this->addSql('DROP TABLE posts_types');
        $this->addSql('DROP TABLE privacy_type');
        $this->addSql('DROP TABLE reacts');
        $this->addSql('DROP TABLE reports');
        $this->addSql('DROP TABLE role_has_permissions');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE saved_posts');
        $this->addSql('DROP TABLE sources');
        $this->addSql('DROP TABLE sources_types');
        $this->addSql('DROP TABLE sponsored');
        $this->addSql('DROP TABLE sponsored_ages');
        $this->addSql('DROP TABLE sponsored_reach');
        $this->addSql('DROP TABLE sponsored_time');
        $this->addSql('DROP TABLE states');
        $this->addSql('DROP TABLE stories');
        $this->addSql('DROP TABLE user_categories');
        $this->addSql('DROP TABLE user_pages');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE websockets_statistics_entries');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY comments_comment_id_foreign');
        $this->addSql('DROP INDEX comments_comment_id_foreign ON comments');
        $this->addSql('DROP INDEX comments_user_id_foreign ON comments');
        $this->addSql('ALTER TABLE comments DROP user_id, DROP comment_id, DROP model_id, DROP model_type, DROP created_at, DROP updated_at, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE body text LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_post_id_foreign');
        $this->addSql('DROP INDEX posts_page_id_foreign ON posts');
        $this->addSql('DROP INDEX posts_privacyid_foreign ON posts');
        $this->addSql('DROP INDEX posts_categoryid_foreign ON posts');
        $this->addSql('DROP INDEX posts_post_id_foreign ON posts');
        $this->addSql('DROP INDEX posts_stateid_foreign ON posts');
        $this->addSql('DROP INDEX posts_group_id_foreign ON posts');
        $this->addSql('DROP INDEX posts_posttypeid_foreign ON posts');
        $this->addSql('DROP INDEX posts_publisherid_foreign ON posts');
        $this->addSql('ALTER TABLE posts ADD image VARCHAR(20) NOT NULL, DROP group_id, DROP page_id, DROP post_id, DROP price, DROP postTypeId, DROP privacyId, DROP stateId, DROP publisherId, DROP categoryId, DROP created_at, DROP updated_at, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE body description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bad_words (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categories (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name_ar VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chat (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, contacts VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cities (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, country_id BIGINT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX cities_country_id_foreign (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE countries (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE failed_jobs (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, connection TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, payload LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, exception LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, failed_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE following (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, followerId BIGINT UNSIGNED NOT NULL, followingId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX following_followingid_foreign (followingId), INDEX following_followerid_foreign (followerId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE friendships (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, senderId BIGINT UNSIGNED NOT NULL, receiverId BIGINT UNSIGNED NOT NULL, stateId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX friendships_receiverid_foreign (receiverId), INDEX friendships_stateid_foreign (stateId), INDEX friendships_senderid_foreign (senderId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE group_members (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id BIGINT UNSIGNED NOT NULL, group_id BIGINT UNSIGNED NOT NULL, stateId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX group_members_group_id_foreign (group_id), INDEX group_members_stateid_foreign (stateId), INDEX group_members_user_id_foreign (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE groups (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, category_id BIGINT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, profile_image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cover_image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, privacy SMALLINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX groups_category_id_foreign (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE likes (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, model_id SMALLINT UNSIGNED NOT NULL, model_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, reactId BIGINT UNSIGNED NOT NULL, senderId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX likes_senderid_foreign (senderId), INDEX likes_reactid_foreign (reactId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE media (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, filename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mediaType VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, model_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, model_id BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mention (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, mentionTypeId BIGINT UNSIGNED NOT NULL, senderId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX mention_senderid_foreign (senderId), INDEX mention_mentiontypeid_foreign (mentionTypeId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mention_types (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE messages (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, message VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, userId BIGINT UNSIGNED NOT NULL, chatId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX messages_userid_foreign (userId), INDEX messages_chatid_foreign (chatId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE migrations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, migration VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, batch INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE model_has_permissions (permission_id BIGINT UNSIGNED NOT NULL, model_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, model_id BIGINT UNSIGNED NOT NULL, INDEX model_has_permissions_model_id_model_type_index (model_id, model_type), INDEX IDX_6B22422AFED90CCA (permission_id), PRIMARY KEY(permission_id, model_id, model_type)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE model_has_roles (role_id BIGINT UNSIGNED NOT NULL, model_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, model_id BIGINT UNSIGNED NOT NULL, INDEX model_has_roles_model_id_model_type_index (model_id, model_type), INDEX IDX_747E57EAD60322AC (role_id), PRIMARY KEY(role_id, model_id, model_type)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notifications (id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, notifiable_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, notifiable_id BIGINT UNSIGNED NOT NULL, data TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, read_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX notifications_notifiable_type_notifiable_id_index (notifiable_type, notifiable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE packaging_companies (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name_ar VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, details VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, stateId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX packaging_companies_stateid_foreign (stateId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE packaging_companies_phones (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, packaging_company_id BIGINT UNSIGNED NOT NULL, phoneNumber VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX packaging_companies_phones_packaging_company_id_foreign (packaging_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pages (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, category_id BIGINT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, profile_image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cover_image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX pages_category_id_foreign (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE password_resets (email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, token VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, INDEX password_resets_email_index (email)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE permissions (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, guard_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE posts_types (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name_ar VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE privacy_type (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name_ar VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reacts (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reports (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, body VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, stateId BIGINT UNSIGNED NOT NULL, model_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, model_id SMALLINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX reports_stateid_foreign (stateId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE role_has_permissions (permission_id BIGINT UNSIGNED NOT NULL, role_id BIGINT UNSIGNED NOT NULL, INDEX role_has_permissions_role_id_foreign (role_id), INDEX IDX_8BDE50C2FED90CCA (permission_id), PRIMARY KEY(permission_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE roles (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, guard_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE saved_posts (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id BIGINT UNSIGNED NOT NULL, post_id BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX saved_posts_user_id_foreign (user_id), INDEX saved_posts_post_id_foreign (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sources (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, sourceId VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, sourceTypeId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX sources_sourcetypeid_foreign (sourceTypeId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sources_types (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sponsored (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, age_id BIGINT UNSIGNED NOT NULL, country_id BIGINT UNSIGNED NOT NULL, city_id BIGINT UNSIGNED NOT NULL, timeId BIGINT UNSIGNED NOT NULL, reachId BIGINT UNSIGNED NOT NULL, postId BIGINT UNSIGNED NOT NULL, stateId BIGINT UNSIGNED NOT NULL, gender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price DOUBLE PRECISION UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX sponsored_timeid_foreign (timeId), INDEX sponsored_stateid_foreign (stateId), INDEX sponsored_city_id_foreign (city_id), INDEX sponsored_reachid_foreign (reachId), INDEX sponsored_age_id_foreign (age_id), INDEX sponsored_postid_foreign (postId), INDEX sponsored_country_id_foreign (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sponsored_ages (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, `from` INT UNSIGNED NOT NULL, `to` INT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sponsored_reach (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, reach INT UNSIGNED NOT NULL, price DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sponsored_time (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, duration VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE states (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stories (id INT AUTO_INCREMENT NOT NULL, body VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, privacyId INT NOT NULL, publisherId INT NOT NULL, INDEX privacyId (privacyId), INDEX publisherId (publisherId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_categories (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, categoryId BIGINT UNSIGNED NOT NULL, userId BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX user_categories_categoryid_foreign (categoryId), INDEX user_categories_userid_foreign (userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_pages (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id BIGINT UNSIGNED NOT NULL, page_id BIGINT UNSIGNED NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX user_pages_user_id_foreign (user_id), INDEX user_pages_page_id_foreign (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email_verified_at DATETIME DEFAULT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, verification_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, birthDate DATE DEFAULT NULL, remember_token VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type SMALLINT UNSIGNED DEFAULT 0 NOT NULL, phone VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, jobTitle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, country VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, personal_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, cover_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, stateId BIGINT UNSIGNED DEFAULT NULL, UNIQUE INDEX users_email_unique (email), INDEX users_stateid_foreign (stateId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE websockets_statistics_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, peak_connection_count INT NOT NULL, websocket_message_count INT NOT NULL, api_message_count INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cities ADD CONSTRAINT cities_country_id_foreign FOREIGN KEY (country_id) REFERENCES countries (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE following ADD CONSTRAINT following_followerid_foreign FOREIGN KEY (followerId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE following ADD CONSTRAINT following_followingid_foreign FOREIGN KEY (followingId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE friendships ADD CONSTRAINT friendships_receiverid_foreign FOREIGN KEY (receiverId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE friendships ADD CONSTRAINT friendships_senderid_foreign FOREIGN KEY (senderId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE friendships ADD CONSTRAINT friendships_stateid_foreign FOREIGN KEY (stateId) REFERENCES states (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_members ADD CONSTRAINT group_members_group_id_foreign FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_members ADD CONSTRAINT group_members_stateid_foreign FOREIGN KEY (stateId) REFERENCES states (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_members ADD CONSTRAINT group_members_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groups ADD CONSTRAINT groups_category_id_foreign FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT likes_reactid_foreign FOREIGN KEY (reactId) REFERENCES reacts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT likes_senderid_foreign FOREIGN KEY (senderId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mention ADD CONSTRAINT mention_mentiontypeid_foreign FOREIGN KEY (mentionTypeId) REFERENCES mention_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mention ADD CONSTRAINT mention_senderid_foreign FOREIGN KEY (senderId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT messages_chatid_foreign FOREIGN KEY (chatId) REFERENCES chat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT messages_userid_foreign FOREIGN KEY (userId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_has_permissions ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_has_roles ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE packaging_companies ADD CONSTRAINT packaging_companies_stateid_foreign FOREIGN KEY (stateId) REFERENCES states (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE packaging_companies_phones ADD CONSTRAINT packaging_companies_phones_packaging_company_id_foreign FOREIGN KEY (packaging_company_id) REFERENCES packaging_companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pages ADD CONSTRAINT pages_category_id_foreign FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reports ADD CONSTRAINT reports_stateid_foreign FOREIGN KEY (stateId) REFERENCES states (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_has_permissions ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_has_permissions ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saved_posts ADD CONSTRAINT saved_posts_post_id_foreign FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saved_posts ADD CONSTRAINT saved_posts_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sources ADD CONSTRAINT sources_sourcetypeid_foreign FOREIGN KEY (sourceTypeId) REFERENCES sources_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsored ADD CONSTRAINT sponsored_age_id_foreign FOREIGN KEY (age_id) REFERENCES sponsored_ages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsored ADD CONSTRAINT sponsored_city_id_foreign FOREIGN KEY (city_id) REFERENCES cities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsored ADD CONSTRAINT sponsored_country_id_foreign FOREIGN KEY (country_id) REFERENCES countries (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsored ADD CONSTRAINT sponsored_postid_foreign FOREIGN KEY (postId) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsored ADD CONSTRAINT sponsored_reachid_foreign FOREIGN KEY (reachId) REFERENCES sponsored_reach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsored ADD CONSTRAINT sponsored_stateid_foreign FOREIGN KEY (stateId) REFERENCES states (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsored ADD CONSTRAINT sponsored_timeid_foreign FOREIGN KEY (timeId) REFERENCES sponsored_time (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categories ADD CONSTRAINT user_categories_categoryid_foreign FOREIGN KEY (categoryId) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categories ADD CONSTRAINT user_categories_userid_foreign FOREIGN KEY (userId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_pages ADD CONSTRAINT user_pages_page_id_foreign FOREIGN KEY (page_id) REFERENCES pages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_pages ADD CONSTRAINT user_pages_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT users_stateid_foreign FOREIGN KEY (stateId) REFERENCES states (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE articale');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE osama');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE word');
        $this->addSql('ALTER TABLE comments ADD user_id BIGINT UNSIGNED NOT NULL, ADD comment_id BIGINT UNSIGNED DEFAULT NULL, ADD model_id BIGINT UNSIGNED NOT NULL, ADD model_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, CHANGE id id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE text body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT comments_comment_id_foreign FOREIGN KEY (comment_id) REFERENCES comments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT comments_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX comments_comment_id_foreign ON comments (comment_id)');
        $this->addSql('CREATE INDEX comments_user_id_foreign ON comments (user_id)');
        $this->addSql('ALTER TABLE posts ADD group_id BIGINT UNSIGNED DEFAULT NULL, ADD page_id BIGINT UNSIGNED DEFAULT NULL, ADD post_id BIGINT UNSIGNED DEFAULT NULL, ADD price DOUBLE PRECISION UNSIGNED DEFAULT NULL, ADD postTypeId BIGINT UNSIGNED NOT NULL, ADD privacyId BIGINT UNSIGNED NOT NULL, ADD stateId BIGINT UNSIGNED NOT NULL, ADD publisherId BIGINT UNSIGNED NOT NULL, ADD categoryId BIGINT UNSIGNED NOT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP image, CHANGE id id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE description body VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_categoryid_foreign FOREIGN KEY (categoryId) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_group_id_foreign FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_page_id_foreign FOREIGN KEY (page_id) REFERENCES pages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_post_id_foreign FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_posttypeid_foreign FOREIGN KEY (postTypeId) REFERENCES posts_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_privacyid_foreign FOREIGN KEY (privacyId) REFERENCES privacy_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_publisherid_foreign FOREIGN KEY (publisherId) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_stateid_foreign FOREIGN KEY (stateId) REFERENCES states (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX posts_page_id_foreign ON posts (page_id)');
        $this->addSql('CREATE INDEX posts_privacyid_foreign ON posts (privacyId)');
        $this->addSql('CREATE INDEX posts_categoryid_foreign ON posts (categoryId)');
        $this->addSql('CREATE INDEX posts_post_id_foreign ON posts (post_id)');
        $this->addSql('CREATE INDEX posts_stateid_foreign ON posts (stateId)');
        $this->addSql('CREATE INDEX posts_group_id_foreign ON posts (group_id)');
        $this->addSql('CREATE INDEX posts_posttypeid_foreign ON posts (postTypeId)');
        $this->addSql('CREATE INDEX posts_publisherid_foreign ON posts (publisherId)');
    }
}
