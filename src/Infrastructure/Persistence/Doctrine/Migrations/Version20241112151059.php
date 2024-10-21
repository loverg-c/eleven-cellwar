<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112151059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_user (id UUID NOT NULL, planet_id UUID DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_88BDF3E9A25E9820 ON app_user (planet_id)');
        $this->addSql('COMMENT ON COLUMN app_user.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN app_user.planet_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE cell (id UUID NOT NULL, game_session_id UUID DEFAULT NULL, pos_x INT NOT NULL, pos_y INT NOT NULL, is_spawn BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CB8787E28FE32B32 ON cell (game_session_id)');
        $this->addSql('COMMENT ON COLUMN cell.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cell.game_session_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE cell_unit (id UUID NOT NULL, user_id UUID DEFAULT NULL, cell_id UUID DEFAULT NULL, nb_units INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6F7065F5A76ED395 ON cell_unit (user_id)');
        $this->addSql('CREATE INDEX IDX_6F7065F5CB39D93A ON cell_unit (cell_id)');
        $this->addSql('COMMENT ON COLUMN cell_unit.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cell_unit.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cell_unit.cell_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game_session (id UUID NOT NULL, begin_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, draft BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN game_session.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game_session_user (game_session_id UUID NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(game_session_id, user_id))');
        $this->addSql('CREATE INDEX IDX_A532E20D8FE32B32 ON game_session_user (game_session_id)');
        $this->addSql('CREATE INDEX IDX_A532E20DA76ED395 ON game_session_user (user_id)');
        $this->addSql('COMMENT ON COLUMN game_session_user.game_session_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session_user.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game_turn (begin_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, game_session_id UUID DEFAULT NULL, PRIMARY KEY(begin_at))');
        $this->addSql('CREATE INDEX IDX_CB35796B8FE32B32 ON game_turn (game_session_id)');
        $this->addSql('COMMENT ON COLUMN game_turn.game_session_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE planet (id UUID NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, color_code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN planet.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E9A25E9820 FOREIGN KEY (planet_id) REFERENCES planet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cell ADD CONSTRAINT FK_CB8787E28FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cell_unit ADD CONSTRAINT FK_6F7065F5A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cell_unit ADD CONSTRAINT FK_6F7065F5CB39D93A FOREIGN KEY (cell_id) REFERENCES cell (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_user ADD CONSTRAINT FK_A532E20D8FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_user ADD CONSTRAINT FK_A532E20DA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_turn ADD CONSTRAINT FK_CB35796B8FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE app_user DROP CONSTRAINT FK_88BDF3E9A25E9820');
        $this->addSql('ALTER TABLE cell DROP CONSTRAINT FK_CB8787E28FE32B32');
        $this->addSql('ALTER TABLE cell_unit DROP CONSTRAINT FK_6F7065F5A76ED395');
        $this->addSql('ALTER TABLE cell_unit DROP CONSTRAINT FK_6F7065F5CB39D93A');
        $this->addSql('ALTER TABLE game_session_user DROP CONSTRAINT FK_A532E20D8FE32B32');
        $this->addSql('ALTER TABLE game_session_user DROP CONSTRAINT FK_A532E20DA76ED395');
        $this->addSql('ALTER TABLE game_turn DROP CONSTRAINT FK_CB35796B8FE32B32');
        $this->addSql('DROP TABLE app_user');
        $this->addSql('DROP TABLE cell');
        $this->addSql('DROP TABLE cell_unit');
        $this->addSql('DROP TABLE game_session');
        $this->addSql('DROP TABLE game_session_user');
        $this->addSql('DROP TABLE game_turn');
        $this->addSql('DROP TABLE planet');
    }
}
