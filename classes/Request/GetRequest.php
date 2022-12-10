<?php

namespace APIModule\Request;

class GetRequest extends BaseRequest {
    protected function prepare() {
        $query = '';

        if (!empty($this->parameters))
            $query = '?' . http_build_query($this->parameters);

        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($this->curl, CURLOPT_URL, $this->url . $query);
    }
}