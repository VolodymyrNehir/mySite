<?php

class Model
{
    const HOST = 'localhost:8889';
    const DB = 'users';
    const USER = 'root';
    const PASSWORD = 'root';
    const TABLE = 'users';

    private static function pdo ()
    {
            try {
                $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB;
                return new PDO($dsn, self::USER, self::PASSWORD);
            } catch (PDOException $e) {
                echo "error: " . $e->getMessage();
            }

    }

    public static function getById($id)
    {
        $query = self::pdo()->prepare("SELECT * FROM `" . self::TABLE . "` WHERE `" . self::TABLE . "`.`id` = :id");
        $query->bindParam(':id', $id,PDO::PARAM_INT);
        $query->execute();
        $arr = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $user ){
            return $user;
        }

    }

    public static function addUser($lastName, $firstName, $role, $status)
    {
        $pdo = self::pdo();
        $sql = "INSERT INTO `" . self::TABLE . "` (`id`, `lastName`, `firstName`, `role`, `status`) VALUES (NULL, ?, ?, ?, ?)";
        $prepare = $pdo->prepare($sql);
        $prepare->execute([$lastName, $firstName, $role, $status]);
        return $pdo->lastInsertId();
    }

    public static function deleteUsers($id)
    {
        $sql = "DELETE FROM `" . self::TABLE . "` WHERE `" . self::TABLE . "`.`id` = :id";
        $prepare = self::pdo()->prepare($sql);
        $prepare->bindParam(':id', $id,PDO::PARAM_INT);
        return $prepare->execute();
    }

    public static function upUsers($id, $lastName, $firstName, $role, $status)
    {
        $sql = "UPDATE `" . self::TABLE . "` SET `lastName` = ?, `firstName` = ?, `role` = ?, `status` = ? WHERE `" . self::TABLE . "`.`id` = ?";
        $prepare = self::pdo()->prepare($sql);
        $prepare->execute([$lastName, $firstName, $role, $status, $id]);
    }

    public static function setAction($id, $status)
    {
        $sql = "UPDATE `" . self::TABLE . "` SET `status` = :status WHERE `" . self::TABLE . "`.`id` = :id";
        $prepare = self::pdo()->prepare($sql);
        $prepare->bindParam(':id', $id,PDO::PARAM_INT);
        $prepare->bindParam(':status', $status,PDO::PARAM_INT);
        $prepare->execute();
    }

    public static function selectUsers()
    {
        $query = self::pdo()->query('SELECT * FROM `' . self::TABLE . '`');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>