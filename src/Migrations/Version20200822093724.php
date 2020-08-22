<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200822093724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_4D68EDE95585C142');
        $this->addSql('DROP INDEX IDX_4D68EDE9166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project_skill AS SELECT project_id, skill_id FROM project_skill');
        $this->addSql('DROP TABLE project_skill');
        $this->addSql('CREATE TABLE project_skill (project_id INTEGER NOT NULL, skill_id INTEGER NOT NULL, PRIMARY KEY(project_id, skill_id), CONSTRAINT FK_4D68EDE9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4D68EDE95585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO project_skill (project_id, skill_id) SELECT project_id, skill_id FROM __temp__project_skill');
        $this->addSql('DROP TABLE __temp__project_skill');
        $this->addSql('CREATE INDEX IDX_4D68EDE95585C142 ON project_skill (skill_id)');
        $this->addSql('CREATE INDEX IDX_4D68EDE9166D1F9C ON project_skill (project_id)');
        $this->addSql('DROP INDEX IDX_58991E41166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__screenshot AS SELECT id, project_id, path FROM screenshot');
        $this->addSql('DROP TABLE screenshot');
        $this->addSql('CREATE TABLE screenshot (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_58991E41166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO screenshot (id, project_id, path) SELECT id, project_id, path FROM __temp__screenshot');
        $this->addSql('DROP TABLE __temp__screenshot');
        $this->addSql('CREATE INDEX IDX_58991E41166D1F9C ON screenshot (project_id)');
        $this->addSql('DROP INDEX IDX_5E3DE47751F3C1BC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__skill AS SELECT id, techno_id, name, description, image FROM skill');
        $this->addSql('DROP TABLE skill');
        $this->addSql('CREATE TABLE skill (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, techno_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, image VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_5E3DE47751F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO skill (id, techno_id, name, description, image) SELECT id, techno_id, name, description, image FROM __temp__skill');
        $this->addSql('DROP TABLE __temp__skill');
        $this->addSql('CREATE INDEX IDX_5E3DE47751F3C1BC ON skill (techno_id)');
        $this->addSql('DROP INDEX IDX_3987EEDC12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__techno AS SELECT id, category_id, name, image FROM techno');
        $this->addSql('DROP TABLE techno');
        $this->addSql('CREATE TABLE techno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, image VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_3987EEDC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO techno (id, category_id, name, image) SELECT id, category_id, name, image FROM __temp__techno');
        $this->addSql('DROP TABLE __temp__techno');
        $this->addSql('CREATE INDEX IDX_3987EEDC12469DE2 ON techno (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_4D68EDE9166D1F9C');
        $this->addSql('DROP INDEX IDX_4D68EDE95585C142');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project_skill AS SELECT project_id, skill_id FROM project_skill');
        $this->addSql('DROP TABLE project_skill');
        $this->addSql('CREATE TABLE project_skill (project_id INTEGER NOT NULL, skill_id INTEGER NOT NULL, PRIMARY KEY(project_id, skill_id))');
        $this->addSql('INSERT INTO project_skill (project_id, skill_id) SELECT project_id, skill_id FROM __temp__project_skill');
        $this->addSql('DROP TABLE __temp__project_skill');
        $this->addSql('CREATE INDEX IDX_4D68EDE9166D1F9C ON project_skill (project_id)');
        $this->addSql('CREATE INDEX IDX_4D68EDE95585C142 ON project_skill (skill_id)');
        $this->addSql('DROP INDEX IDX_58991E41166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__screenshot AS SELECT id, project_id, path FROM screenshot');
        $this->addSql('DROP TABLE screenshot');
        $this->addSql('CREATE TABLE screenshot (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO screenshot (id, project_id, path) SELECT id, project_id, path FROM __temp__screenshot');
        $this->addSql('DROP TABLE __temp__screenshot');
        $this->addSql('CREATE INDEX IDX_58991E41166D1F9C ON screenshot (project_id)');
        $this->addSql('DROP INDEX IDX_5E3DE47751F3C1BC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__skill AS SELECT id, techno_id, name, description, image FROM skill');
        $this->addSql('DROP TABLE skill');
        $this->addSql('CREATE TABLE skill (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, techno_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, image VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO skill (id, techno_id, name, description, image) SELECT id, techno_id, name, description, image FROM __temp__skill');
        $this->addSql('DROP TABLE __temp__skill');
        $this->addSql('CREATE INDEX IDX_5E3DE47751F3C1BC ON skill (techno_id)');
        $this->addSql('DROP INDEX IDX_3987EEDC12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__techno AS SELECT id, category_id, name, image FROM techno');
        $this->addSql('DROP TABLE techno');
        $this->addSql('CREATE TABLE techno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO techno (id, category_id, name, image) SELECT id, category_id, name, image FROM __temp__techno');
        $this->addSql('DROP TABLE __temp__techno');
        $this->addSql('CREATE INDEX IDX_3987EEDC12469DE2 ON techno (category_id)');
    }
}
