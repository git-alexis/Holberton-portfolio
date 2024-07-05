<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628151240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_value (id INT AUTO_INCREMENT NOT NULL, tank_id INT NOT NULL, skill_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_385FCB0815C652B5 (tank_id), UNIQUE INDEX UNIQ_385FCB085585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategy_skill (strategy_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_4B9CDBC3D5CAD932 (strategy_id), INDEX IDX_4B9CDBC35585C142 (skill_id), PRIMARY KEY(strategy_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skill_value ADD CONSTRAINT FK_385FCB0815C652B5 FOREIGN KEY (tank_id) REFERENCES tank (id)');
        $this->addSql('ALTER TABLE skill_value ADD CONSTRAINT FK_385FCB085585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE strategy_skill ADD CONSTRAINT FK_4B9CDBC3D5CAD932 FOREIGN KEY (strategy_id) REFERENCES strategy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE strategy_skill ADD CONSTRAINT FK_4B9CDBC35585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill_value DROP FOREIGN KEY FK_385FCB0815C652B5');
        $this->addSql('ALTER TABLE skill_value DROP FOREIGN KEY FK_385FCB085585C142');
        $this->addSql('ALTER TABLE strategy_skill DROP FOREIGN KEY FK_4B9CDBC3D5CAD932');
        $this->addSql('ALTER TABLE strategy_skill DROP FOREIGN KEY FK_4B9CDBC35585C142');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_value');
        $this->addSql('DROP TABLE strategy');
        $this->addSql('DROP TABLE strategy_skill');
        $this->addSql('DROP TABLE tank');
    }
}
