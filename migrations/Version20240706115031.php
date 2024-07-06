<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240706115031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_strategy (id INT AUTO_INCREMENT NOT NULL, skill_id_id INT DEFAULT NULL, strategy_id_id INT DEFAULT NULL, INDEX IDX_56EE281F5A6C0D6B (skill_id_id), INDEX IDX_56EE281F6AE5A1E3 (strategy_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tank_skill (id INT AUTO_INCREMENT NOT NULL, tank_id_id INT DEFAULT NULL, skill_id_id INT DEFAULT NULL, value DOUBLE PRECISION NOT NULL, INDEX IDX_7E27DBAD5F5EA18D (tank_id_id), INDEX IDX_7E27DBAD5A6C0D6B (skill_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skill_strategy ADD CONSTRAINT FK_56EE281F5A6C0D6B FOREIGN KEY (skill_id_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE skill_strategy ADD CONSTRAINT FK_56EE281F6AE5A1E3 FOREIGN KEY (strategy_id_id) REFERENCES strategy (id)');
        $this->addSql('ALTER TABLE tank_skill ADD CONSTRAINT FK_7E27DBAD5F5EA18D FOREIGN KEY (tank_id_id) REFERENCES tank (id)');
        $this->addSql('ALTER TABLE tank_skill ADD CONSTRAINT FK_7E27DBAD5A6C0D6B FOREIGN KEY (skill_id_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill_strategy DROP FOREIGN KEY FK_56EE281F5A6C0D6B');
        $this->addSql('ALTER TABLE skill_strategy DROP FOREIGN KEY FK_56EE281F6AE5A1E3');
        $this->addSql('ALTER TABLE tank_skill DROP FOREIGN KEY FK_7E27DBAD5F5EA18D');
        $this->addSql('ALTER TABLE tank_skill DROP FOREIGN KEY FK_7E27DBAD5A6C0D6B');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_strategy');
        $this->addSql('DROP TABLE strategy');
        $this->addSql('DROP TABLE tank');
        $this->addSql('DROP TABLE tank_skill');
    }
}
