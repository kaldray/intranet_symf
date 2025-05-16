<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250516101556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, raison_social VARCHAR(255) NOT NULL, adresse_one VARCHAR(255) NOT NULL, code_postal INTEGER NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, forme_juridique VARCHAR(255) NOT NULL, activite VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, actif BOOLEAN NOT NULL, nom_prenom VARCHAR(255) NOT NULL, email_rl VARCHAR(255) NOT NULL, telephone_rl VARCHAR(255) NOT NULL)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE client
        SQL);
    }
}
