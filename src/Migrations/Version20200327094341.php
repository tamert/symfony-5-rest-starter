<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200327094341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Post RENAME INDEX idx_23a0e66f675f31b TO IDX_5A8A6C8DF675F31B');
        $this->addSql('ALTER TABLE Post RENAME INDEX idx_23a0e66bcf5e72d TO IDX_5A8A6C8D12469DE2');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post RENAME INDEX idx_5a8a6c8d12469de2 TO IDX_23A0E66BCF5E72D');
        $this->addSql('ALTER TABLE post RENAME INDEX idx_5a8a6c8df675f31b TO IDX_23A0E66F675F31B');
    }
}
