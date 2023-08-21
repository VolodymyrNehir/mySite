<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];

$pdo = new Model();
foreach ($userId as $user) {
    $res =  $pdo->deleteUsers($user);
    if ($res == 1){
        $response = ["id"=>$user];
    } else {
        $error =   ["code" => "100", "message" => " No found user"];
    }
}
echo json_encode(["status" => true, "error" => $error, $response]);

