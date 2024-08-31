<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831055126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            INSERT INTO test (id, title_value) VALUES 
            (1, \'Math Test\')
        ');

        $this->addSql('
            INSERT INTO question (id, test_id, title_value) VALUES 
            (1, 1, \'1 + 1 = \'),
            (2, 1, \'2 + 2 = \'),
            (3, 1, \'3 + 3 = \'),
            (4, 1, \'4 + 4 = \'),
            (5, 1, \'5 + 5 = \'),
            (6, 1, \'6 + 6 = \'),
            (7, 1, \'7 + 7 = \'),
            (8, 1, \'8 + 8 = \'),
            (9, 1, \'9 + 9 = \'),
            (10, 1, \'10 + 10 = \')
        ');

        $this->addSql('
            INSERT INTO answer (id, question_id, title_value, is_correct) VALUES 
            (1, 1, \'3\', FALSE),
            (2, 1, \'2\', TRUE),
            (3, 1, \'0\', FALSE),
            (4, 2, \'4\', TRUE),
            (5, 2, \'3 + 1\', TRUE),
            (6, 2, \'10\', FALSE),
            (7, 3, \'1 + 5\', TRUE),
            (8, 3, \'1\', FALSE),
            (9, 3, \'6\', TRUE),
            (10, 3, \'2 + 4\', TRUE),
            (11, 4, \'8\', TRUE),
            (12, 4, \'4\', FALSE),
            (13, 4, \'0\', FALSE),
            (14, 4, \'0 + 8\', TRUE),
            (15, 5, \'6\', FALSE),
            (16, 5, \'18\', FALSE),
            (17, 5, \'10\', TRUE),
            (18, 5, \'9\', FALSE),
            (19, 5, \'0\', FALSE),
            (20, 6, \'3\', FALSE),
            (21, 6, \'9\', FALSE),
            (22, 6, \'0\', FALSE),
            (23, 6, \'12\', TRUE),
            (24, 6, \'5 + 7\', TRUE),
            (25, 7, \'5\', FALSE),
            (26, 7, \'14\', TRUE),
            (27, 8, \'16\', TRUE),
            (28, 8, \'12\', FALSE),
            (29, 8, \'9\', FALSE),
            (30, 8, \'5\', FALSE),
            (31, 9, \'18\', TRUE),
            (32, 9, \'9\', FALSE),
            (33, 9, \'17 + 1\', TRUE),
            (34, 9, \'2 + 16\', TRUE),
            (35, 10, \'0\', FALSE),
            (36, 10, \'2\', FALSE),
            (37, 10, \'8\', FALSE),
            (38, 10, \'20\', TRUE)
        ');


    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM answer');
        $this->addSql('DELETE FROM question');
        $this->addSql('DELETE FROM test');
        $this->addSql('DELETE FROM test_result');
    }
}
