<?php

    class Delete {
        public function __construct(private PDO $db) {}
        public function delete($id) {
            $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }