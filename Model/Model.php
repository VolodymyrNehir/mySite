<?php

class Model
{
    private $pdo;

    public function __construct()
    {
        $host = 'localhost:8889';
        $db = 'users';
        $user = 'root';
        $password = 'root';
        try {
            $dsn = "mysql:host=$host;dbname=$db";
            $this->pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }

    }

    public function getById($id)
    {
        $query = $this->pdo->query("SELECT * FROM `users` WHERE `users`.`id` = $id");
        $arr = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $user ){
            return $user;
        }

    }

    public function addUser($lastName, $firstName, $role, $status)
    {
        $sql = "INSERT INTO `users` (`id`, `lastName`, `firstName`, `role`, `status`) VALUES (NULL, ?, ?, ?, ?)";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$lastName, $firstName, $role, $status]);
        return $this->pdo->lastInsertId();    }

    public function deleteUsers($id)
    {
        $sql = "DELETE FROM `users` WHERE `users`.`id` = $id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute();
        return $prepare->rowCount();
    }

    public function upUsers($id, $lastName, $firstName, $role, $status)
    {
        $sql = "UPDATE `users` SET `lastName` = ?, `firstName` = ?, `role` = ?, `status` = ? WHERE `users`.`id` = $id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$lastName, $firstName, $role, $status]);
    }

    public function setAction($id, $status)
    {

        $sql = "UPDATE `users` SET `status` = ? WHERE `users`.`id`=$id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$status]);
    }

    public function selectUsers()
    {
        $query = $this->pdo->query('SELECT * FROM `users`');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>