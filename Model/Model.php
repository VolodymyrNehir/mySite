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
        $query->execute(['id'=> $id]);
        $arr = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $user ){
            return $user;
        }

    }

    public static function addUser($lastName, $firstName, $role, $status)
    {
        $pdo = self::pdo();
        $sql = "INSERT INTO `" . self::TABLE . "` (`id`, `lastName`, `firstName`, `role`, `status`) VALUES (NULL, :lastName, :firstName, :role, :status)";
        $prepare = $pdo->prepare($sql);
        $prepare->execute(['lastName'=> $lastName, 'firstName'=> $firstName, 'role' => $role, 'status'=> $status]);
        return $pdo->lastInsertId();
    }

    public static function deleteUsers($id)
    {
        $sql = "DELETE FROM `" . self::TABLE . "` WHERE `" . self::TABLE . "`.`id` = :id";
        $prepare = self::pdo()->prepare($sql);
        return $prepare->execute(['id'=> $id]);
    }

    public static function upUsers($id, $lastName, $firstName, $role, $status)
    {
        $sql = "UPDATE `" . self::TABLE . "` SET `lastName` = :lastName, `firstName` = :firstName, `role` = :role, `status` = :status WHERE `" . self::TABLE . "`.`id` = :id";
        $prepare = self::pdo()->prepare($sql);
        $prepare->execute(['lastName'=> $lastName, 'firstName'=> $firstName, 'role' => $role, 'status'=> $status, 'id'=> $id]);
    }

    public static function setAction($id, $status)
    {
        $sql = "UPDATE `" . self::TABLE . "` SET `status` = status WHERE `" . self::TABLE . "`.`id` = id'";
        $prepare = self::pdo()->prepare($sql);
        $prepare->execute(['status'=> $status, 'id'=> $id]);
    }

    public static function selectUsers()
    {
        $query = self::pdo()->query('SELECT * FROM `' . self::TABLE . '`');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>