<?php

class Conn
{
    private static $instance = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            try {
                $dsn = 'mysql:host=127.0.0.1;dbname=erp_admin;charset=utf8mb4';
                $user = 'root';
                $password = '123';

                self::$instance = new \PDO($dsn, $user, $password);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (Exception $exception) {
                echo "Erro ao conectar: {$exception->getMessage()}";
            }

            return self::$instance;
        }
    }
}