<?php

    class Read {
        public function __construct(private PDO $db) {}
        public function readAll() {
            $stmt = $this->db->query('SELECT * FROM users');
            return $stmt->fetchAll();
        }
        public function read($id) {
            $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }
    }