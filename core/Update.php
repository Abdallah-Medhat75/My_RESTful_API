<?php

    class Update {
        private $data;
        public function __construct(private PDO $db) {
            $this->data = json_decode(file_get_contents('php://input'), true);
        }
        public function update($id) {
            $stmt = $this->db->prepare('UPDATE users SET name = :name, is_available = :available WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':available', $this->data['is_available'], PDO::PARAM_BOOL);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }