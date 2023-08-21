<?php
include_once "../Model/Model.php";

$form = $_POST['form'];

$pdo = new Model();
foreach ($form['userId'] as $userId) {
    $pdo->setAction($userId, $form['select']);
    $user = $pdo->getById($userId);
    if (!empty($user)) {
        $response[] =
            [
                "id" => $userId,
                "firstName" => $user['firstName'],
                "lastName" => $user['lastName'],
                "role" => $user['role'],
                "status" => $user['status'],
            ];
    } else {
        $error =  ["code" => "100", "message" => "Some of the selected users do not exist"];
    }

}

    echo json_encode(["status" => true, "error" => $error, "user" => $response]);



