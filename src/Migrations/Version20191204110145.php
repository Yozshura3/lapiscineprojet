<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204110145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories ADD category_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668B51A1840 FOREIGN KEY (category_parent_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_3AF34668B51A1840 ON categories (category_parent_id)');
        $this->addSql('ALTER TABLE media ADD url VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668B51A1840');
        $this->addSql('DROP INDEX IDX_3AF34668B51A1840 ON categories');
        $this->addSql('ALTER TABLE categories DROP category_parent_id');
        $this->addSql('ALTER TABLE media DROP url');
    }
}
