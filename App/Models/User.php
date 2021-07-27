<?php

namespace App\Models;

class User
{
    private static $table = 'user';

    public static function find(int $id)
    {
        try {
            $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        } catch (\Exception $e) {
            throw new \Exception("Não foi possível se conectar ao banco!");
        }
        $sql = 'SELECT * FROM ' . self::$table . " WHERE id = :id";
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado");
        }
    }

    public static function findAll()
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado");
        }
    }
}
