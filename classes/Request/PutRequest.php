<?php

namespace APIModule\Request;

class PutRequest extends BaseRequest {
    protected function prepare() {
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->body);
    }
}