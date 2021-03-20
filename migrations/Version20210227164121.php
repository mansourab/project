<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227164121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE memoire ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE memoire ADD CONSTRAINT FK_4A044617A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4A044617A76ED395 ON memoire (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE memoire DROP FOREIGN KEY FK_4A044617A76ED395');
        $this->addSql('DROP INDEX IDX_4A044617A76ED395 ON memoire');
        $this->addSql('ALTER TABLE memoire DROP user_id');
    }
}
