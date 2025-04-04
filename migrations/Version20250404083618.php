<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404083618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE comedian (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_86AE26C6217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE director (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, UNIQUE INDEX UNIQ_1E90D3F0217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comedian ADD CONSTRAINT FK_86AE26C6217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE director ADD CONSTRAINT FK_1E90D3F0217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE movie ADD category_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1D5EF26F12469DE2 ON movie (category_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE comedian DROP FOREIGN KEY FK_86AE26C6217BBB47
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE director DROP FOREIGN KEY FK_1E90D3F0217BBB47
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE comedian
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE director
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1D5EF26F12469DE2 ON movie
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE movie DROP category_id
        SQL);
    }
}
