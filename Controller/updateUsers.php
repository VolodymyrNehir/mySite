<?php
include_once "../Model/Model.php";
//include_once "../codeStatus/CodeStatus.php";

$form = $_POST['form'];


$pdo = new Model();

foreach ($form['userId'] as $userId) {
    $user = $pdo->getById($userId);
    $errorStatus = $pdo->setAction($userId, $form['select']);
    if ($errorStatus == false) {
        $response[] = ["status" => $errorStatus, "error" => ["code" => '100', "user" => $user], "user" =>
            [
                "id" => $user,
                "firstName" => $user['firstName'],
                "lastName" => $user['lastName'],
                "role" => $user['role'],
                "status" => $user['status'],
            ]
        ];
    }
    else {
        $response[] = ["status" => $errorStatus, "error" => ["code" => '100', "message" => 'failed to provide status']];

    }
//    $res = $pdo->setAction($user, $form['select']);
//    $arrStatus[] = CodeStatus::myStatusCodeUsers($user, $res, '100', 'failed to provide status');
}
echo json_encode($response);