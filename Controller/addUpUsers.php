<?php
include_once '../Model/Model.php';

$userId = intval($_POST['userId']);
$lastName = trim(filter_var($_POST['lastName'],FILTER_SANITIZE_STRING));
$firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
$status = $_POST['status'];
$role = $_POST['role'];

$errorStatus = 'true';
$code = '100';
$user = Model::getById($userId);

if (empty($lastName)) {
    $response[] = ["field" => "lastName", "message" => " Please fill in your last name"];
}
if (empty($firstName)) {
    $response[] = ["field" => "firstName", "message" => " Please fill in your first name"];

}
if (empty($role)) {
    $response[] = ["field" => "role", "message" => " Please select a role"];
}

if (empty($user) && $userId !== '"null"') {
    $response[] = ["field" => "noFind", "message" => " No found user"];
}

if (!empty($response)) {
    exit(json_encode(["status" => false, "error" => $response]));
}

if ($userId == '"null"') {
    $newId = Model::addUser($lastName, $firstName, $role, $status);
    $userNew = Model::getById($newId);
    if (isset($userNew)) {
        $response = ["status" => true, "error" => "null", "user" =>
            [
                "id" => $newId,
                "firstName" => $userNew['firstName'],
                "lastName" => $userNew['lastName'],
                "role" => $userNew['role'],
                "status" => $userNew['status'],
            ]
        ];
    } else {
        $response = ["status" => false, "error" => ["code" => "100", "message" => " failed to add user"]];
    }
} else {
    Model::upUsers($userId, $lastName, $firstName, $role, $status);
    $userNewUp = Model::getById($userId);
    if (!empty($user)) {
        $response = ["status" => true, "error" => "null", "user" =>
            [
                "id" => $userId,
                "firstName" => $userNewUp['firstName'],
                "lastName" => $userNewUp['lastName'],
                "role" => $userNewUp['role'],
                "status" => $userNewUp['status'],
            ]
        ];
    }
}
echo json_encode($response);
