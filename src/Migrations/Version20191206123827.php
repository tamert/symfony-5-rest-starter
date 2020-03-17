<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206123827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Post ADD author_id INT NOT NULL, ADD Category_id INT NOT NULL');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES Author (id)');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (Category_id) REFERENCES Category (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66F675F31B ON Post (author_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66BCF5E72D ON Post (Category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Post DROP FOREIGN KEY FK_23A0E66F675F31B');
        $this->addSql('ALTER TABLE Post DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('DROP INDEX IDX_23A0E66F675F31B ON Post');
        $this->addSql('DROP INDEX IDX_23A0E66BCF5E72D ON Post');
        $this->addSql('ALTER TABLE Post DROP author_id, DROP Category_id');
    }
}
