<?php

namespace APIModule\Request;

use Exception;

abstract class BaseRequest {

    public $url = '';
    public $headers = [];
    public $body = '';
    public $parameters = [];
    public $curl;

    public function __construct() {
        $this->curl = curl_init();
    }

    protected abstract function prepare();

    public function send() {

        $this->prepare();

        if (isset($this->headers) && !empty($this->headers))
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);

        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($this->curl);

        curl_close ($this->curl);

        return $server_output;
    }

    public function setBody($body) {
        if (!isset($this->headers) || empty($this->headers)) {
            throw new Exception('Headers not set');
        }

        if (in_array('Content-Type: application/x-www-form-urlencoded', $this->headers)) {
            $this->body = http_build_query($body);
        } else {
            $this->body = json_encode($body);
        }
    }

    public function setHeaders($headers) {
        $this->headers = $headers;
    }

    public function addParameters($parameters) {
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    public function setUrl($url) {
        $this->url = $url;
    }
}