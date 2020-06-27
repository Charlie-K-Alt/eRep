<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608162919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appartenir (id INT AUTO_INCREMENT NOT NULL, matieres_id INT NOT NULL, niveaux_id INT NOT NULL, INDEX IDX_A2A0D90C82350831 (matieres_id), INDEX IDX_A2A0D90CAAC4B70E (niveaux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apprenants (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, nom VARCHAR(30) NOT NULL, prenoms VARCHAR(50) NOT NULL, telephone INT DEFAULT NULL, email VARCHAR(30) NOT NULL, password VARCHAR(32) NOT NULL, pseudo VARCHAR(10) NOT NULL, datenaissance DATE NOT NULL, sexe VARCHAR(1) NOT NULL, INDEX IDX_C71C2982727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercices (id INT AUTO_INCREMENT NOT NULL, repetiteur_id INT NOT NULL, situation_id INT NOT NULL, enonce LONGTEXT NOT NULL, INDEX IDX_1387EAE1E7305180 (repetiteur_id), INDEX IDX_1387EAE13408E8AF (situation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscriptions (id INT AUTO_INCREMENT NOT NULL, apprenants_id INT NOT NULL, niveau_id INT NOT NULL, utilisateurs_id INT NOT NULL, dateins DATE NOT NULL, frais NUMERIC(10, 0) NOT NULL, INDEX IDX_74E0281CD4B7C9BD (apprenants_id), INDEX IDX_74E0281CB3E9C81 (niveau_id), INDEX IDX_74E0281C1E969C5 (utilisateurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres (id INT AUTO_INCREMENT NOT NULL, codmat VARCHAR(10) NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveaux (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(10) NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(50) NOT NULL, tel VARCHAR(20) NOT NULL, email VARCHAR(30) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repetiteur (id INT AUTO_INCREMENT NOT NULL, utilisateurs_id INT DEFAULT NULL, nom VARCHAR(40) NOT NULL, prenoms VARCHAR(50) NOT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(30) NOT NULL, password VARCHAR(255) NOT NULL, diplome VARCHAR(50) NOT NULL, adresse VARCHAR(40) DEFAULT NULL, INDEX IDX_308FF2A21E969C5 (utilisateurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE situation (id INT AUTO_INCREMENT NOT NULL, titre_sa VARCHAR(50) NOT NULL, contenu_sa LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solutions (id INT AUTO_INCREMENT NOT NULL, repetiteur_id INT NOT NULL, exercices_id INT NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_A90F77EE7305180 (repetiteur_id), INDEX IDX_A90F77E192C7251 (exercices_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenoms VARCHAR(50) NOT NULL, adresse VARCHAR(60) DEFAULT NULL, droit VARCHAR(30) NOT NULL, email VARCHAR(30) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartenir ADD CONSTRAINT FK_A2A0D90C82350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id)');
        $this->addSql('ALTER TABLE appartenir ADD CONSTRAINT FK_A2A0D90CAAC4B70E FOREIGN KEY (niveaux_id) REFERENCES niveaux (id)');
        $this->addSql('ALTER TABLE apprenants ADD CONSTRAINT FK_C71C2982727ACA70 FOREIGN KEY (parent_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE exercices ADD CONSTRAINT FK_1387EAE1E7305180 FOREIGN KEY (repetiteur_id) REFERENCES repetiteur (id)');
        $this->addSql('ALTER TABLE exercices ADD CONSTRAINT FK_1387EAE13408E8AF FOREIGN KEY (situation_id) REFERENCES situation (id)');
        $this->addSql('ALTER TABLE inscriptions ADD CONSTRAINT FK_74E0281CD4B7C9BD FOREIGN KEY (apprenants_id) REFERENCES apprenants (id)');
        $this->addSql('ALTER TABLE inscriptions ADD CONSTRAINT FK_74E0281CB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveaux (id)');
        $this->addSql('ALTER TABLE inscriptions ADD CONSTRAINT FK_74E0281C1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE repetiteur ADD CONSTRAINT FK_308FF2A21E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE solutions ADD CONSTRAINT FK_A90F77EE7305180 FOREIGN KEY (repetiteur_id) REFERENCES repetiteur (id)');
        $this->addSql('ALTER TABLE solutions ADD CONSTRAINT FK_A90F77E192C7251 FOREIGN KEY (exercices_id) REFERENCES exercices (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscriptions DROP FOREIGN KEY FK_74E0281CD4B7C9BD');
        $this->addSql('ALTER TABLE solutions DROP FOREIGN KEY FK_A90F77E192C7251');
        $this->addSql('ALTER TABLE appartenir DROP FOREIGN KEY FK_A2A0D90C82350831');
        $this->addSql('ALTER TABLE appartenir DROP FOREIGN KEY FK_A2A0D90CAAC4B70E');
        $this->addSql('ALTER TABLE inscriptions DROP FOREIGN KEY FK_74E0281CB3E9C81');
        $this->addSql('ALTER TABLE apprenants DROP FOREIGN KEY FK_C71C2982727ACA70');
        $this->addSql('ALTER TABLE exercices DROP FOREIGN KEY FK_1387EAE1E7305180');
        $this->addSql('ALTER TABLE solutions DROP FOREIGN KEY FK_A90F77EE7305180');
        $this->addSql('ALTER TABLE exercices DROP FOREIGN KEY FK_1387EAE13408E8AF');
        $this->addSql('ALTER TABLE inscriptions DROP FOREIGN KEY FK_74E0281C1E969C5');
        $this->addSql('ALTER TABLE repetiteur DROP FOREIGN KEY FK_308FF2A21E969C5');
        $this->addSql('DROP TABLE appartenir');
        $this->addSql('DROP TABLE apprenants');
        $this->addSql('DROP TABLE exercices');
        $this->addSql('DROP TABLE inscriptions');
        $this->addSql('DROP TABLE matieres');
        $this->addSql('DROP TABLE niveaux');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE repetiteur');
        $this->addSql('DROP TABLE situation');
        $this->addSql('DROP TABLE solutions');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
