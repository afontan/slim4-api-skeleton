<?php declare(strict_types=1);

namespace App\Controller\Base;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class BaseController
{
    const API_NAME = 'skel-api-slim-php';

    const API_VERSION = '0.0.1';

    protected $container;

    public function __construct($container)
    {
//        var_dump($container); exit;
        $this->container = $container;
    }

    public function getHelp($request, $response)
    {
        $message = [
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

//        $response->getBody()->write("hello api version: " . self::API_VERSION);

//        return $response;
        
//        $data = array('name' => 'Rob', 'age' => 40);
        $payload = json_encode($message);

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
//        return $response->withJson($message, 200);
    }

    public function getStatus($request, $response)
    {
        $this->container->get('db');
        $status = [
            'status' => [
                'database' => 'OK',
            ],
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

//        $response->getBody()->write("hello status: " . 'OK');

//        return $response;
        $payload = json_encode($status);

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        
//        return $response->withJson($status, 200);
    }
}
