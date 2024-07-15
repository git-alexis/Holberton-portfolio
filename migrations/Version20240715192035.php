<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715195035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds created_by column to tank, skill, strategy, tank_skill, and skill_strategy tables.';
    }

    public function up(Schema $schema): void
    {
        // Add created_by column to the tank table
        $this->addSql('ALTER TABLE tank ADD COLUMN created_by VARCHAR(255) NOT NULL');
        
        // Add created_by column to the skill table
        $this->addSql('ALTER TABLE skill ADD COLUMN created_by VARCHAR(255) NOT NULL');
        
        // Add created_by column to the strategy table
        $this->addSql('ALTER TABLE strategy ADD COLUMN created_by VARCHAR(255) NOT NULL');
        
        // Add created_by column to the tank_skill table
        $this->addSql('ALTER TABLE tank_skill ADD COLUMN created_by VARCHAR(255) NOT NULL');
        
        // Add created_by column to the skill_strategy table
        $this->addSql('ALTER TABLE skill_strategy ADD COLUMN created_by VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // Remove created_by column from the tank table
        $this->addSql('ALTER TABLE tank DROP COLUMN created_by');
        
        // Remove created_by column from the skill table
        $this->addSql('ALTER TABLE skill DROP COLUMN created_by');
        
        // Remove created_by column from the strategy table
        $this->addSql('ALTER TABLE strategy DROP COLUMN created_by');
        
        // Remove created_by column from the tank_skill table
        $this->addSql('ALTER TABLE tank_skill DROP COLUMN created_by');
        
        // Remove created_by column from the skill_strategy table
        $this->addSql('ALTER TABLE skill_strategy DROP COLUMN created_by');
    }
}
