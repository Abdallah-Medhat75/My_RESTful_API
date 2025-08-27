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
        private function serveSpec($method, $id) {
            switch($method) {
                case 'GET':
                    echo json_encode($this->read->read($id));
                    break;
            }
        }
        private function serveProcessSpec($id, $operation) {
            switch($operation) {
                case 'update':
                    echo json_encode(['Update_Success' => "{$this->update->update($id)} Rows Has Been Updated Successfully"]);
                    break;
                case 'delete':
                    echo json_encode(['Delete_Success' => "{$this->delete->delete($id)} Rows Has Been Deleted Successfully"]);
                    break;
            }
        }
        public function serve(string $method, ?string $id, ?string $operation) {
            if ($id && $operation) {
                $this->serveProcessSpec($id, $operation);
            } else if ($id) {
                $this->serveSpec($method, $id);
            } else {
                $this->serveAll($method);
            }
        }
    }