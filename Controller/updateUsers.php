<?php
include_once "../Model/Model.php";

$form = $_POST['form'];

$pdo = new Model();
foreach ($form['userId'] as $userId) {
    $pdo->setAction($userId, $form['select']);
    $user = $pdo->getById($userId);
    if (!empty($user)) {
        $response[] = ["status" => true, "error" => 'null', "user" =>
            [
                "id" => $userId,
                "firstName" => $user['firstName'],
                "lastName" => $user['lastName'],
                "role" => $user['role'],
                "status" => $user['status'],
            ]
        ];
    } else {
        $response[] = ["status" => false, "error" => ["code" => "100", "message" => " No found user"]]
        ;
    }
}
echo json_encode($response);
