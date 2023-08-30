<?php
include_once "../Model/Model.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form = [];

    if (isset($_POST['checkInfo'])) {
        $form = $_POST['checkInfo'];
    }


    $error = null;
    $user = '';
    foreach ($form['userId'] as $userId) {
            Model::setAction($userId, $form['select']);
            $user = Model::getById($userId);
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

}