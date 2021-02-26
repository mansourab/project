<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226115653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE memoire_options (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE memoire ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE memoire ADD CONSTRAINT FK_4A044617C54C8C93 FOREIGN KEY (type_id) REFERENCES memoire_options (id)');
        $this->addSql('CREATE INDEX IDX_4A044617C54C8C93 ON memoire (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE memoire DROP FOREIGN KEY FK_4A044617C54C8C93');
        $this->addSql('DROP TABLE memoire_options');
        $this->addSql('DROP INDEX IDX_4A044617C54C8C93 ON memoire');
        $this->addSql('ALTER TABLE memoire DROP type_id');
    }
}
