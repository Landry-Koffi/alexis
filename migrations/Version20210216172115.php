<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216172115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_cv (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvtheque (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, reference_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, disponible TINYINT(1) NOT NULL, INDEX IDX_BB54F34912469DE2 (category_id), UNIQUE INDEX UNIQ_BB54F3491645DEA9 (reference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cvtheque ADD CONSTRAINT FK_BB54F34912469DE2 FOREIGN KEY (category_id) REFERENCES category_cv (id)');
        $this->addSql('ALTER TABLE cvtheque ADD CONSTRAINT FK_BB54F3491645DEA9 FOREIGN KEY (reference_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cvtheque DROP FOREIGN KEY FK_BB54F34912469DE2');
        $this->addSql('DROP TABLE category_cv');
        $this->addSql('DROP TABLE cvtheque');
    }
}
