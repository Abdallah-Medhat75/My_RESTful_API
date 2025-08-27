<?php

    class Read {
        public function __construct(private PDO $db) {}
        public function readAll() {
            $stmt = $this->db->query('SELECT * FROM users');
            $data = $stmt->fetchAll();
            foreach ($data as &$usersData) {
                $usersData['is_available'] = (bool) $usersData['is_available'];
            }
            unset($usersData);
            return $data;
        }
        public function read($ids) {
            if (count($ids) > 1) {
                $usersData = [];
                foreach ($ids as $id) {
                    $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $usersData[] = $stmt->fetch();
                }
                return $usersData;
            }
            $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
            $stmt->bindValue(':id', $ids[0], PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch();
            $data['is_available'] = (bool) $data['is_available'];       
            return $data;
        }
    }