<?php

namespace APIModule\Framework;

class Response {
    public $Status = 200;
    public $ContentType = 'application/json';
    public $Data = '';

    public function send() {
        http_response_code($this->Status);
        header('Content-type: ' . $this->ContentType);
        echo json_encode($this->Data);
        exit;
    }
}