<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704130321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autores (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(60) DEFAULT NULL, tipo VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editoriales (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(60) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE libros (id INT AUTO_INCREMENT NOT NULL, id_editorial_id INT DEFAULT NULL, titulo VARCHAR(120) DEFAULT NULL, isbn VARCHAR(30) DEFAULT NULL, edicion VARCHAR(4) DEFAULT NULL, publicacion VARCHAR(4) DEFAULT NULL, categoria VARCHAR(30) DEFAULT NULL, INDEX IDX_B7E5AFE69930D73F (id_editorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE libros_autores (libros_id INT NOT NULL, autores_id INT NOT NULL, INDEX IDX_66DC967432D1DF44 (libros_id), INDEX IDX_66DC9674C5CD6563 (autores_id), PRIMARY KEY(libros_id, autores_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE libros ADD CONSTRAINT FK_B7E5AFE69930D73F FOREIGN KEY (id_editorial_id) REFERENCES editoriales (id)');
        $this->addSql('ALTER TABLE libros_autores ADD CONSTRAINT FK_66DC967432D1DF44 FOREIGN KEY (libros_id) REFERENCES libros (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE libros_autores ADD CONSTRAINT FK_66DC9674C5CD6563 FOREIGN KEY (autores_id) REFERENCES autores (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE libros_autores DROP FOREIGN KEY FK_66DC9674C5CD6563');
        $this->addSql('ALTER TABLE libros DROP FOREIGN KEY FK_B7E5AFE69930D73F');
        $this->addSql('ALTER TABLE libros_autores DROP FOREIGN KEY FK_66DC967432D1DF44');
        $this->addSql('DROP TABLE autores');
        $this->addSql('DROP TABLE editoriales');
        $this->addSql('DROP TABLE libros');
        $this->addSql('DROP TABLE libros_autores');
    }
}
