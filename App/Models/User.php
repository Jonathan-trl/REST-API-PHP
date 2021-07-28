<?php

namespace App\Models;

use PDOException;

class User
{
    private static $table = 'user';

    public static function getUser(int $id)
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

    public static function getAllUsers()
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

    public static function storeUser($data)
    {
        $data = json_decode($data);
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'INSERT INTO ' . self::$table . ' (name, email, phone, password) VALUES (:name, :email, :phone, :pass)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(":name", $data->name);
        $stmt->bindValue(":email", $data->email);
        $stmt->bindValue(":phone", $data->phone);
        $stmt->bindValue(":pass", $data->password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Usuário inserido com sucesso!";
        } else {
            throw new \Exception("Falha ao inserir usuário");
        }
    }

    public static function updateUser($id, $data)
    {
        $data = json_decode($data);
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $connPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = 'UPDATE ' . self::$table . ' SET name = :name, email = :email, phone = :phone, password = :pass WHERE id = :id';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":name", $data->name);
        $stmt->bindValue(":email", $data->email);
        $stmt->bindValue(":phone", $data->phone);
        $stmt->bindValue(":pass", $data->password);
        $stmt->execute();
        if ($stmt->execute()) {
            return "Usuário alterado com sucesso!";
        } else {
            throw new \PDOException;
        }
    }

    public static function deleteUser()
    {
        # code...
    }
}
