<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210613063357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courses (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news ADD course_id INT NOT NULL');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950591CC992 FOREIGN KEY (course_id) REFERENCES courses (id)');
        $this->addSql('CREATE INDEX IDX_1DD39950591CC992 ON news (course_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950591CC992');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP INDEX IDX_1DD39950591CC992 ON news');
        $this->addSql('ALTER TABLE news DROP course_id');
    }
}
