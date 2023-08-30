<?php
include_once '../Model/Model.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = '';
    $res = false;
    if (isset($_POST['userId'])) {
        $userId = $_POST['userId'];
    }

    foreach ($userId as $user) {
        if (is_numeric($user)){
            $res = Model::deleteUsers($user);
        }

        if ($res === true) {
            $response = ["status" => true, "error" => null];
        } else {
            $response = ["status" => false, "error" => "error connect database"];
        }
    }

    echo json_encode($response);
}

