<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250420143831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE income (id SERIAL NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3FA862D0A76ED395 ON income (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE income ADD CONSTRAINT FK_3FA862D0A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
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
            ALTER TABLE income DROP CONSTRAINT FK_3FA862D0A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE income
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bill ALTER amount TYPE INT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ALTER avatar TYPE VARCHAR(4096)
        SQL);
    }
}
