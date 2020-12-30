<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201230185900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stage ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_3BDBC6DA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_3BDBC6DA4AEAFEA ON stage (entreprise_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Stage DROP FOREIGN KEY FK_3BDBC6DA4AEAFEA');
        $this->addSql('DROP INDEX IDX_3BDBC6DA4AEAFEA ON Stage');
        $this->addSql('ALTER TABLE Stage DROP entreprise_id');
    }
}
