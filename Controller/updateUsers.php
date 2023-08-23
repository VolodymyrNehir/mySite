<?php
include_once "../Model/Model.php";

$form = $_POST['checkInfo'];

$pdo = new Model();
$error = null;
foreach ($form['userId'] as $userId) {
    $pdo->setAction($userId, $form['select']);
    $user = $pdo->getById($userId);
    if (!empty($user)) {
        $response[] =
            [
                "id" => $userId,
                "status" => $user['status'],
            ];
    } else {
        $error = ["code" => "100", "message" => "Some of the selected users do not exist"];
    }

}
if (!empty($response)) {
    echo json_encode(["status" => true, "error" => $error, "users" => $response]);
}
if (empty($response)) {
    echo json_encode(["status" => false, "error" => $error]);
}

