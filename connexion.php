<?php

//SINGLETON
class DBConnector
{

    public static function connexion()
    {
        $dbname = 'bot-crypto';
        $host = 'localhost';
        $user = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$password");
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
