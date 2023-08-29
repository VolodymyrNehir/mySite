<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];

foreach ($userId as  $user) {
    $res =  Model::deleteUsers(intval($user));
    if ($res === true){
        $response = ["status" => true, "error" => null];
    } else {
        $response = ["status" => false, "error" => "error connect database"];
    }
}

    echo json_encode($response);


