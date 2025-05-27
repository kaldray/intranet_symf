<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250526201907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE facture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, application_id INTEGER NOT NULL, file VARCHAR(255) NOT NULL, date DATE NOT NULL, date_echeance DATE NOT NULL, status VARCHAR(255) NOT NULL, montant_ht DOUBLE PRECISION NOT NULL, montant_tva DOUBLE PRECISION NOT NULL, montant_ttc DOUBLE PRECISION NOT NULL, CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FE8664103E030ACD FOREIGN KEY (application_id) REFERENCES application (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FE86641019EB6921 ON facture (client_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FE8664103E030ACD ON facture (application_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE facture
        SQL);
    }
}
