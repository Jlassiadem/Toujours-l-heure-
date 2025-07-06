<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250706232713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment CHANGE datePosted date_posted DATETIME NOT NULL, CHANGE isReported is_reported TINYINT(1) NOT NULL, CHANGE reportReason report_reason VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX idx_9474526ca76ed395 ON comment');
        $this->addSql('CREATE INDEX IDX_9474526C6B3CA4B ON comment (id_user)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (id_user) REFERENCES user (id_user) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD heure_arrivee VARCHAR(255) NOT NULL, ADD heure_sortie VARCHAR(255) NOT NULL, ADD type_commande VARCHAR(255) NOT NULL, ADD lieu_depart VARCHAR(255) NOT NULL, ADD lieu_arrivee VARCHAR(255) NOT NULL, DROP heureArrivee, DROP heureSortie, DROP typeCommande, DROP lieuDepart, DROP lieuArrivee, CHANGE dateRes date_res DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6B3CA4B');
        $this->addSql('ALTER TABLE comment CHANGE date_posted datePosted DATETIME NOT NULL, CHANGE is_reported isReported TINYINT(1) NOT NULL, CHANGE report_reason reportReason VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX idx_9474526c6b3ca4b ON comment');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (id_user)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD heureArrivee VARCHAR(255) NOT NULL, ADD heureSortie VARCHAR(255) NOT NULL, ADD typeCommande VARCHAR(255) NOT NULL, ADD lieuDepart VARCHAR(255) NOT NULL, ADD lieuArrivee VARCHAR(255) NOT NULL, DROP heure_arrivee, DROP heure_sortie, DROP type_commande, DROP lieu_depart, DROP lieu_arrivee, CHANGE date_res dateRes DATE NOT NULL');
    }
}
