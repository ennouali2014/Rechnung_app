<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226211202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ansteller (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, strasse VARCHAR(255) NOT NULL, plz VARCHAR(255) NOT NULL, ort VARCHAR(255) NOT NULL, steuer_nr VARCHAR(255) NOT NULL, bank VARCHAR(255) NOT NULL, kontonummer VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bezeichnung (id INT AUTO_INCREMENT NOT NULL, menge DOUBLE PRECISION DEFAULT NULL, description LONGTEXT NOT NULL, einzelpreis DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kunde (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, strasse VARCHAR(255) NOT NULL, plz VARCHAR(255) NOT NULL, ort VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rechnung (id INT AUTO_INCREMENT NOT NULL, kunde_id INT NOT NULL, ansteller_id INT NOT NULL, titel LONGTEXT NOT NULL, erstellungdate DATE NOT NULL, bestellung VARCHAR(255) DEFAULT NULL, leistung VARCHAR(255) NOT NULL, zahlungart VARCHAR(255) DEFAULT NULL, gesamtnetto DOUBLE PRECISION NOT NULL, mwst DOUBLE PRECISION NOT NULL, gesamtbrutto DOUBLE PRECISION NOT NULL, kunden_name VARCHAR(255) NOT NULL, kunden_strasse VARCHAR(255) NOT NULL, kunden_plz VARCHAR(255) NOT NULL, kunden_ort VARCHAR(255) NOT NULL, INDEX IDX_D490F3E79D4738BC (kunde_id), INDEX IDX_D490F3E7D87E3C13 (ansteller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rechnung_bezeichnung (rechnung_id INT NOT NULL, bezeichnung_id INT NOT NULL, INDEX IDX_CBC1A78A57222FB (rechnung_id), INDEX IDX_CBC1A78A92AD904A (bezeichnung_id), PRIMARY KEY(rechnung_id, bezeichnung_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rechnung ADD CONSTRAINT FK_D490F3E79D4738BC FOREIGN KEY (kunde_id) REFERENCES kunde (id)');
        $this->addSql('ALTER TABLE rechnung ADD CONSTRAINT FK_D490F3E7D87E3C13 FOREIGN KEY (ansteller_id) REFERENCES ansteller (id)');
        $this->addSql('ALTER TABLE rechnung_bezeichnung ADD CONSTRAINT FK_CBC1A78A57222FB FOREIGN KEY (rechnung_id) REFERENCES rechnung (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rechnung_bezeichnung ADD CONSTRAINT FK_CBC1A78A92AD904A FOREIGN KEY (bezeichnung_id) REFERENCES bezeichnung (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rechnung DROP FOREIGN KEY FK_D490F3E79D4738BC');
        $this->addSql('ALTER TABLE rechnung DROP FOREIGN KEY FK_D490F3E7D87E3C13');
        $this->addSql('ALTER TABLE rechnung_bezeichnung DROP FOREIGN KEY FK_CBC1A78A57222FB');
        $this->addSql('ALTER TABLE rechnung_bezeichnung DROP FOREIGN KEY FK_CBC1A78A92AD904A');
        $this->addSql('DROP TABLE ansteller');
        $this->addSql('DROP TABLE bezeichnung');
        $this->addSql('DROP TABLE kunde');
        $this->addSql('DROP TABLE rechnung');
        $this->addSql('DROP TABLE rechnung_bezeichnung');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
