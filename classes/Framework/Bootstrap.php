<?php

namespace APIModule\Framework;

use Exception;
use TypeError;

class Bootstrap {
    public static function handle() {

        $Response = new Response();

        self::handleRequest($Response);

        $Response->send();
    }

    public static function handleRequest(Response &$Response) {
        $RequestMethod = $_SERVER['REQUEST_METHOD'];
        $Endpoint = $_REQUEST['endpoint'] ?? '/';

        $Router = new Router($RequestMethod, $Endpoint);
        $Params = self::getParams($RequestMethod);

        try {
            if (!$Router->Status) {
                self::notFound($Response);
            } else {
                self::found($Router, $Params, $Response);
            }
        } catch (Exception $e) {
            var_export($e->getMessage());
            $Response->Status = 400;
        } catch (TypeError $e) {
            echo 'Invalid argument for request.';
            $Response->Status = 400;
        }
    }

    private static function notFound( &$Response) {
        $Response->Status = 404;
    }

    private static function found(Router $Router, array $Params, Response &$Response) {
        if (in_array($Router->RequestMethod, ['POST', 'PUT']))
            $Response->Status = 201;

        $Callback = new Callback($Router->getClass(), $Router->getMethod(), $Params);

        $Response->Data = $Callback->run();
    }

    private static function getParams(string $RequestMethod) {
        $Params = [];

        if ($RequestMethod == 'POST') {
            if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
                $Params = json_decode(file_get_contents('php://input'), true);
            } else {
                $Params = $_POST;
            }
        } elseif ($RequestMethod == 'GET') {
            $Params = $_GET;
        }

        return $Params;
    }
}