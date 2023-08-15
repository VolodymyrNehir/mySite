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
        try {
            $dsn = "mysql:host=$host;dbname=$db";
            $this->pdo = new PDO($dsn, $user, $password);
        }catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }

    }


    public function getById($id)
    {
        $query = $this->pdo->query("SELECT * FROM `administrstor` WHERE `administrstor`.`id` = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser($lastName, $firstName, $role, $status)
    {
        $sql = "INSERT INTO `administrstor` (`id`, `lastName`, `firestName`, `role`, `status`) VALUES (NULL, ?, ?, ?, ?)";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$lastName, $firstName, $role, $status]);
        return $this->pdo->lastInsertId();
    }

    public function deleteUsers($id)
    {
        $sql = "DELETE FROM `administrstor` WHERE `administrstor`.`id` = $id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute();

    }

    public function upUsers($id, $lastName, $firstName, $role, $status)
    {
        $sql = "UPDATE `administrstor` SET `lastName` = ?, `firestName` = ?, `role` = ?, `status` = ? WHERE `administrstor`.`id` = $id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$lastName, $firstName, $role, $status]);
    }

    public function setAction($id, $status)
    {
        $sql = "UPDATE `administrstor` SET `status` = ? WHERE `administrstor`.`id`=$id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([$status]);
    }

    public function selectUsers()
    {
        $query = $this->pdo->query('SELECT * FROM `administrstor`');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>