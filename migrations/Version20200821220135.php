<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200821220135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE products ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE products ALTER sku SET NOT NULL');
        $this->addSql('ALTER TABLE products ALTER name SET NOT NULL');
        $this->addSql('ALTER TABLE products ALTER price SET NOT NULL');
        $this->addSql('ALTER TABLE products ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE products_id_seq CASCADE');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE products DROP id');
        $this->addSql('ALTER TABLE products ALTER sku DROP NOT NULL');
        $this->addSql('ALTER TABLE products ALTER name DROP NOT NULL');
        $this->addSql('ALTER TABLE products ALTER price DROP NOT NULL');
    }
}
