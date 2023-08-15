<?php

class Model
{
    private $pdo;

    public function __construct()
    {
        $host = 'localhost:8889';
        $db = 'saitAdmin';
        $user = 'root';
        $password = 'root';

        $dsn = "mysql:host=$host;dbname=$db";
        $this->pdo = new PDO($dsn, $user, $password);
    }


    public function getById($id)
    {
        try {
            $query = $this->pdo->query("SELECT * FROM `administrstor` WHERE `administrstor`.`id` = $id");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }
    }

    public function addUser($lastName, $firstName, $role, $status)
    {
        try {
            $sql = "INSERT INTO `administrstor` (`id`, `lastName`, `firestName`, `role`, `status`) VALUES (NULL, ?, ?, ?, ?)";
            $prepare = $this->pdo->prepare($sql);
            $prepare->execute([$lastName, $firstName, $role, $status]);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }
    }

    public function deleteUsers($id)
    {
        try {
            $sql = "DELETE FROM `administrstor` WHERE `administrstor`.`id` = $id";
            $prepare = $this->pdo->prepare($sql);
            $prepare->execute();
            echo 'duuu';

        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }

    }

    public function upUsers($id, $lastName, $firstName, $role, $status)
    {
        try {
            $sql = "UPDATE `administrstor` SET `lastName` = ?, `firestName` = ?, `role` = ?, `status` = ? WHERE `administrstor`.`id` = $id";
            $prepare = $this->pdo->prepare($sql);
            $prepare->execute([$lastName, $firstName, $role, $status]);
        } catch (PDOException $e) {
            echo "error " . $e->getMessage();
        }
    }

    public function setAction($id, $status)
    {
        try {
            $sql = "UPDATE `administrstor` SET `status` = ? WHERE `administrstor`.`id`=$id";
            $prepare = $this->pdo->prepare($sql);
            $prepare->execute([$status]);
        } catch (PDOException $e) {
            echo "error " . $e->getMessage();
        }
    }

    public function selectUsers()
    {
        try {
            $query = $this->pdo->query('SELECT * FROM `administrstor`');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "error " . $e->getMessage();
        }
    }

}

?>