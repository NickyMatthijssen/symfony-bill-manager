<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424184634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE bill RENAME COLUMN url_value TO url
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill ALTER COLUMN url DROP NOT NULL;
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill ALTER amount TYPE INT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ALTER avatar TYPE VARCHAR(4096)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ALTER avatar TYPE VARCHAR(4096)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill RENAME COLUMN url TO url_value
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill ALTER COLUMN url_value SET NOT NULL;
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill ALTER amount TYPE INT
        SQL);
    }
}
