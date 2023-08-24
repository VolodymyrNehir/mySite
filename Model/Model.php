<?php

class Model
{
    private $pdo;
    const HOST = 'localhost:8889';
    const DB = 'users';
    const USER = 'root';
    const PASSWORD = 'root';
    const TABLE = 'users';

    public function __construct()
    {
            try {
                $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB;
                $this->pdo = new PDO($dsn, self::USER, self::PASSWORD);
            } catch (PDOException $e) {
                echo "error: " . $e->getMessage();
            }

    }

    public function getById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM `" . self::TABLE . "` WHERE `" . self::TABLE . "`.`id` = ?");
        $query->execute([$id]);
        $arr = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $user ){
            return $user;
        }

    }

    public function addUser($lastName, $firstName, $role, $status)
    {
        $sql = "INSERT INTO `" . self::TABLE . "` (`id`, `lastName`, `firstName`, `role`, `status`) VALUES (NULL, ?, ?, ?, ?)";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$lastName, $firstName, $role, $status]);
        return $this->pdo->lastInsertId();
    }

    public function deleteUsers($id)
    {
        $sql = "DELETE FROM `" . self::TABLE . "` WHERE `" . self::TABLE . "`.`id` = ?";
        $prepare = $this->pdo->prepare($sql);
        return $prepare->execute([$id]);
    }

    public function upUsers($id, $lastName, $firstName, $role, $status)
    {
        $sql = "UPDATE `" . self::TABLE . "` SET `lastName` = ?, `firstName` = ?, `role` = ?, `status` = ? WHERE `" . self::TABLE . "`.`id` = ?";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$lastName, $firstName, $role, $status, $id]);
    }

    public function setAction($id, $status)
    {
        $sql = "UPDATE `" . self::TABLE . "` SET `status` = ? WHERE `" . self::TABLE . "`.`id` = ?";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$status, $id]);
    }

    public function selectUsers()
    {
        $query = $this->pdo->query('SELECT * FROM `' . self::TABLE . '`');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>