<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];

$pdo = new Model();

foreach ($userId as $user){
    $pdo->deleteUsers($user);
}
