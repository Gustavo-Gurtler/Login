<?php

use Slim\App;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/login/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/login/' route");

        

        // Render index view
        return $container->get('renderer')->render($response, 'login.phtml', $args);
    });

    $app->post('/login/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/login/' route");

        $conexao = $container->get('pdo');
        $params = $request->getParsedBody();
        $resultSet = $conexao->query('SELECT * FROM usuario WHERE email = "'. $params['email']. '" AND senha = "' . md5($params['senha']) . '"')->fetchAll();
      
        if (count($resultSet) == 1){
            return $response->withRedirect('/');
         echo"acesso liberado";
    } else {
        echo "ACESSO NEGADO";
    }
        exit;
      
        // Render index view
        return $container->get('renderer')->render($response, 'login.phtml', $args);


        
        
    });
};