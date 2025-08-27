<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    spl_autoload_register(function ($className) {
        require "core/$className.php";
    });
    set_error_handler('ErrorHandler::ErrorHandler');
    set_exception_handler('ErrorHandler::ExceptionHandler');

    $url = explode('/', $_SERVER['REQUEST_URI']);
    $tableName = array_key_exists(4, $url) ? $url[4] : NULL;
    $ids = array_key_exists(5, $url) ? explode(',', $url[5]) : NULL;
    $operation = array_key_exists(6, $url) ? $url[6] : NULL;

    $connect = new connect('mysql:host=localhost;dbname=restful_api;charset=utf8mb4', 'root', '');
    $dbConnection = $connect->connect();

    $read = new Read($dbConnection);
    $create = new Create($dbConnection);
    $update = new Update($dbConnection);
    $delete = new Delete($dbConnection);

    $serve = new Controller($read, $create, $update, $delete);
    $serve->serve($_SERVER['REQUEST_METHOD'], $ids, $operation);

