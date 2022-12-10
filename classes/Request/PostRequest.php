<?php

namespace APIModule\Request;

class PostRequest extends BaseRequest {
    protected function prepare() {
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->body);
    }
}