<?php

use Dba\Connection;

    class Create {
        private $data;
        public function __construct(private PDO $db) {
            $this->data = json_decode(file_get_contents('php://input'), true);
        }
        public function create() {
            $stmt = $this->db->prepare('INSERT INTO users(name, is_available) VALUES(:name, :available)');
            $stmt->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':available', $this->data['is_available'], PDO::PARAM_BOOL);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }