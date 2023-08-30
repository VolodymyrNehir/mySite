<?php
include_once '../Model/Model.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userId'])) {
        $userId = $_POST['userId'];
    }

    foreach ($userId as $user) {
        $res = Model::deleteUsers($user);
        if ($res === true) {
            $response = ["status" => true, "error" => null];
        } else {
            $response = ["status" => false, "error" => "error connect database"];
        }
    }

    echo json_encode($response);
}

