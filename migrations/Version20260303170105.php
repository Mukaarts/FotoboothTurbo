<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260303170105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial schema: user, project, customer, event, customer_link, template, design, approval_log, export';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, display_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_date DATE NOT NULL, location VARCHAR(255) NOT NULL, notes LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tags JSON DEFAULT NULL, source VARCHAR(20) NOT NULL, config_schema JSON DEFAULT NULL, thumbnail_path VARCHAR(500) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, owner_id INT NOT NULL, customer_id INT NOT NULL, event_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2FB3D0EE7E3C61F9 (owner_id), UNIQUE INDEX UNIQ_2FB3D0EE9395C3F3 (customer_id), UNIQUE INDEX UNIQ_2FB3D0EE71F7E88B (event_id), PRIMARY KEY(id), CONSTRAINT FK_project_owner FOREIGN KEY (owner_id) REFERENCES `user` (id), CONSTRAINT FK_project_customer FOREIGN KEY (customer_id) REFERENCES customer (id), CONSTRAINT FK_project_event FOREIGN KEY (event_id) REFERENCES event (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_link (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, token VARCHAR(64) NOT NULL, expires_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', tarif_tier VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_623D3D865F37A13B (token), UNIQUE INDEX UNIQ_623D3D86166D1F9C (project_id), PRIMARY KEY(id), CONSTRAINT FK_customerlink_project FOREIGN KEY (project_id) REFERENCES project (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE design (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, template_id INT DEFAULT NULL, customizations JSON DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_CD4F5A30166D1F9C (project_id), INDEX IDX_CD4F5A305DA0FB8 (template_id), PRIMARY KEY(id), CONSTRAINT FK_design_project FOREIGN KEY (project_id) REFERENCES project (id), CONSTRAINT FK_design_template FOREIGN KEY (template_id) REFERENCES template (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE approval_log (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, status VARCHAR(255) NOT NULL, comment LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E41565A6166D1F9C (project_id), PRIMARY KEY(id), CONSTRAINT FK_approvallog_project FOREIGN KEY (project_id) REFERENCES project (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE export (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, zip_path VARCHAR(500) NOT NULL, target_software VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_428C1694166D1F9C (project_id), PRIMARY KEY(id), CONSTRAINT FK_export_project FOREIGN KEY (project_id) REFERENCES project (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE export');
        $this->addSql('DROP TABLE approval_log');
        $this->addSql('DROP TABLE design');
        $this->addSql('DROP TABLE customer_link');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE template');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE `user`');
    }
}
