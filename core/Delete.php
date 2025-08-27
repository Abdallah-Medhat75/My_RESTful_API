<?php

    class Delete {
        public function __construct(private PDO $db) {}
        public function delete($ids) {
            if (count($ids) > 1) {
                $count = 0;
                foreach ($ids as $id) {
                    $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $count += $stmt->rowCount();
                }
                return $count;
            }
            $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
            $stmt->bindValue(':id', $ids[0], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }