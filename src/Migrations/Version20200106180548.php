<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106180548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_sujet ADD topic_id INT NOT NULL, ADD title VARCHAR(255) NOT NULL, ADD message LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE post_sujet ADD CONSTRAINT FK_B908D5721F55203D FOREIGN KEY (topic_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_B908D5721F55203D ON post_sujet (topic_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_sujet DROP FOREIGN KEY FK_B908D5721F55203D');
        $this->addSql('DROP INDEX IDX_B908D5721F55203D ON post_sujet');
        $this->addSql('ALTER TABLE post_sujet DROP topic_id, DROP title, DROP message');
    }
}
