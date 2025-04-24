<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250417235227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE bill ADD url VARCHAR(255) NOT NULL DEFAULT 'https://google.com'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill ALTER COLUMN url DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill ADD icon VARCHAR(100) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill DROP url
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill DROP icon
        SQL);
    }
}
