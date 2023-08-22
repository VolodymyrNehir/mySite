<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];

$pdo = new Model();
foreach ($userId as $user) {
    $res =  $pdo->deleteUsers($user);
    if ($res === true){
        $response = ["status" => true, "error" => "null"];
    }
}

    echo json_encode($response);


