<?php

    class ErrorHandler {
        public static function ExceptionHandler(Throwable $exception) {
            echo json_encode([
                'code' => $exception->getCode(),
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine()
            ]);
        }
        public static function ErrorHandler($errno, $errstr, $errfile, $errline) {
            throw New ErrorException($errstr, 0, $errno, $errfile, $errline);
        }
    }