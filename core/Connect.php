<?php

    class Connect {
        public function __construct(private string $dsn, private string $user, private string $pass) {}
        public function connect() {
            $db = new PDO($this->dsn, $this->user, $this->pass);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $db;
        }
    }