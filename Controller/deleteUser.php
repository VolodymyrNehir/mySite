<?php
include_once '../Model/Model.php';
include_once '../codeStatus/CodeStatus.php';

$userId = $_POST['userId'];

$pdo = new Model();
$errorUsers = [];
$users = [];
foreach ($userId as $user){
    if (!$pdo->deleteUsers($user)){
        $errorUsers[] = json_decode(CodeStatus::myCodeStatus1('false','100','Not found user',$user));
    } else {
         CodeStatus::myCodeStatus('true','','');
        $users[] = json_decode(CodeStatus::myCodeStatus('true','',''));
    }
}

echo json_encode($users);
