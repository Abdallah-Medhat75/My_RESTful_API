<?php

    class Controller {
        public function __construct(private Read $read, private Create $create, private Update $update, private Delete $delete) {}
        private function serveAll($method) {
            switch($method) {
                case 'GET':
                    echo json_encode($this->read->readAll());
                    break;
                case 'POST':
                    echo json_encode(['Add_Success' => "{$this->create->create()} row Added Successfully"]);
                    break;
            }
        }
        private function serveProcessSpec($ids, $operation) {
            switch($operation) {
                case 'update':
                    echo json_encode(['Update_Success' => "{$this->update->update($ids)} Rows Has Been Updated Successfully"]);
                    break;
                case 'delete':
                    echo json_encode(['Delete_Success' => "{$this->delete->delete($ids)} Rows Has Been Deleted Successfully"]);
                    break;
            }
        }
        private function serveProcessMultiple($ids, $operation = NULL) {
            if ($operation == NULL) {
                echo json_encode($this->read->read($ids));
                exit;
            }
            switch($operation) {
                case 'delete':
                    echo json_encode(['delete_success' => "{$this->delete->delete($ids)} users has been deleted successfully"]);
                    break;
            }
        }
        private function serveSpec($method, $ids) {
            switch($method) {
                case 'GET':
                    echo json_encode($this->read->read($ids));
                    break;
            }
        }
        public function serve(string $method, ?array $ids, ?string $operation) {
            if ($ids && $operation) {
                count($ids) > 1 ? $this->serveProcessMultiple($ids, $operation) : $this->serveProcessSpec($ids, $operation);
            } else if ($ids) {
                $this->serveSpec($method, $ids);
            } else {
                $this->serveAll($method);
            }
        }
    }