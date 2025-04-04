<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404084327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE casting (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE casting_movie (casting_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_CACC89289EB2648F (casting_id), INDEX IDX_CACC89288F93B6FC (movie_id), PRIMARY KEY(casting_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE casting_comedian (casting_id INT NOT NULL, comedian_id INT NOT NULL, INDEX IDX_21B1EF019EB2648F (casting_id), INDEX IDX_21B1EF011D3228F (comedian_id), PRIMARY KEY(casting_id, comedian_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE casting_role (casting_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_C8C0238B9EB2648F (casting_id), INDEX IDX_C8C0238BD60322AC (role_id), PRIMARY KEY(casting_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_movie ADD CONSTRAINT FK_CACC89289EB2648F FOREIGN KEY (casting_id) REFERENCES casting (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_movie ADD CONSTRAINT FK_CACC89288F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_comedian ADD CONSTRAINT FK_21B1EF019EB2648F FOREIGN KEY (casting_id) REFERENCES casting (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_comedian ADD CONSTRAINT FK_21B1EF011D3228F FOREIGN KEY (comedian_id) REFERENCES comedian (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_role ADD CONSTRAINT FK_C8C0238B9EB2648F FOREIGN KEY (casting_id) REFERENCES casting (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_role ADD CONSTRAINT FK_C8C0238BD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_movie DROP FOREIGN KEY FK_CACC89289EB2648F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_movie DROP FOREIGN KEY FK_CACC89288F93B6FC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_comedian DROP FOREIGN KEY FK_21B1EF019EB2648F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_comedian DROP FOREIGN KEY FK_21B1EF011D3228F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_role DROP FOREIGN KEY FK_C8C0238B9EB2648F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE casting_role DROP FOREIGN KEY FK_C8C0238BD60322AC
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE casting
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE casting_movie
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE casting_comedian
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE casting_role
        SQL);
    }
}
