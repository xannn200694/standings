<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210321125415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE championship (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, status VARCHAR(255) NOT NULL COMMENT \'(DC2Type:championship_status)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE division_games (id INT AUTO_INCREMENT NOT NULL, first_team_id INT DEFAULT NULL, second_team_id INT DEFAULT NULL, division_id INT DEFAULT NULL, first_team_score INT NOT NULL, second_team_score INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D667CF2F3AE0B452 (first_team_id), INDEX IDX_D667CF2F3E2E58C3 (second_team_id), INDEX IDX_D667CF2F41859289 (division_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE divisions (id INT AUTO_INCREMENT NOT NULL, championship_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1C40C3194DDBCE9 (championship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playoff (id INT AUTO_INCREMENT NOT NULL, championship_id INT DEFAULT NULL, winner_id INT DEFAULT NULL, step VARCHAR(255) NOT NULL COMMENT \'(DC2Type:playoff_step)\', UNIQUE INDEX UNIQ_68AAF5CE94DDBCE9 (championship_id), UNIQUE INDEX UNIQ_68AAF5CE5DFCD4B8 (winner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playoff_matches (id INT AUTO_INCREMENT NOT NULL, playoff_id INT DEFAULT NULL, first_team_id INT DEFAULT NULL, second_team_id INT DEFAULT NULL, step VARCHAR(255) NOT NULL COMMENT \'(DC2Type:playoff_match_step)\', first_team_score INT NOT NULL, second_team_score INT NOT NULL, INDEX IDX_3AC1BAB8A2B8211C (playoff_id), INDEX IDX_3AC1BAB83AE0B452 (first_team_id), INDEX IDX_3AC1BAB83E2E58C3 (second_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT AUTO_INCREMENT NOT NULL, division_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_96C2225841859289 (division_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE division_games ADD CONSTRAINT FK_D667CF2F3AE0B452 FOREIGN KEY (first_team_id) REFERENCES teams (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE division_games ADD CONSTRAINT FK_D667CF2F3E2E58C3 FOREIGN KEY (second_team_id) REFERENCES teams (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE division_games ADD CONSTRAINT FK_D667CF2F41859289 FOREIGN KEY (division_id) REFERENCES divisions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE divisions ADD CONSTRAINT FK_1C40C3194DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playoff ADD CONSTRAINT FK_68AAF5CE94DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('ALTER TABLE playoff ADD CONSTRAINT FK_68AAF5CE5DFCD4B8 FOREIGN KEY (winner_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE playoff_matches ADD CONSTRAINT FK_3AC1BAB8A2B8211C FOREIGN KEY (playoff_id) REFERENCES playoff (id)');
        $this->addSql('ALTER TABLE playoff_matches ADD CONSTRAINT FK_3AC1BAB83AE0B452 FOREIGN KEY (first_team_id) REFERENCES teams (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playoff_matches ADD CONSTRAINT FK_3AC1BAB83E2E58C3 FOREIGN KEY (second_team_id) REFERENCES teams (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C2225841859289 FOREIGN KEY (division_id) REFERENCES divisions (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE divisions DROP FOREIGN KEY FK_1C40C3194DDBCE9');
        $this->addSql('ALTER TABLE playoff DROP FOREIGN KEY FK_68AAF5CE94DDBCE9');
        $this->addSql('ALTER TABLE division_games DROP FOREIGN KEY FK_D667CF2F41859289');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C2225841859289');
        $this->addSql('ALTER TABLE playoff_matches DROP FOREIGN KEY FK_3AC1BAB8A2B8211C');
        $this->addSql('ALTER TABLE division_games DROP FOREIGN KEY FK_D667CF2F3AE0B452');
        $this->addSql('ALTER TABLE division_games DROP FOREIGN KEY FK_D667CF2F3E2E58C3');
        $this->addSql('ALTER TABLE playoff DROP FOREIGN KEY FK_68AAF5CE5DFCD4B8');
        $this->addSql('ALTER TABLE playoff_matches DROP FOREIGN KEY FK_3AC1BAB83AE0B452');
        $this->addSql('ALTER TABLE playoff_matches DROP FOREIGN KEY FK_3AC1BAB83E2E58C3');
        $this->addSql('DROP TABLE championship');
        $this->addSql('DROP TABLE division_games');
        $this->addSql('DROP TABLE divisions');
        $this->addSql('DROP TABLE playoff');
        $this->addSql('DROP TABLE playoff_matches');
        $this->addSql('DROP TABLE teams');
    }
}
