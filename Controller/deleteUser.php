<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];

$pdo = new Model();
foreach ($userId as $user) {
    $res =  $pdo->deleteUsers($user);
    if ($res == 1){
        $arrStatus[] = ["status" => "true", "error" => "null","id"=>$user];
    } else {
        $arrStatus[] =  ["status" => "false", "error" => ["code" => "100", "message" => " No found user"]];
    }
}
echo json_encode($arrStatus);


