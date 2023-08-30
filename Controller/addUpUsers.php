<?php
include_once '../Model/Model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $userId = '';
    $lastName = '';
    $firstName = '';
    $status = '';
    $role = '';

    if (isset($_POST['userId']) && is_numeric($_POST['userId'])){
        $userId = $_POST['userId'];
    }
    if (isset($_POST['lastName'])){
        $lastName = trim(filter_var($_POST['lastName'],FILTER_SANITIZE_STRING));
    }
    if (isset($_POST['firstName'])){
        $firstName =  trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
    }
    if (isset($_POST['status']) && is_numeric($_POST['status'])){
        $status = $_POST['status'];
    }
    if (isset($_POST['role']) && is_numeric($_POST['role'])){
        $role = $_POST['role'];
    }

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

if (empty($user) && !empty($userId)) {
    $response[] = ["field" => "noFind", "message" => " No found user"];
}

if (!empty($response)) {
    exit(json_encode(["status" => false, "error" => $response]));
}

if (empty($userId)) {
    $newId = Model::addUser($lastName, $firstName, $role, $status);
    $userNew = Model::getById($newId);
    if (isset($userNew)) {
        $response = ["status" => true, "error" => null, "user" =>
            [
                "id" => $newId,
                "firstName" => $userNew['firstName'],
                "lastName" => $userNew['lastName'],
            ]
        ];
    } else {
        $response = ["status" => false, "error" => ["code" => "100", "message" => " failed to add user"]];
    }
} else {
    Model::upUsers($userId, $lastName, $firstName, $role, $status);
    $userNewUp = Model::getById($userId);
    if (!empty($user)) {
        $response = ["status" => true, "error" => null, "user" =>
            [
                "id" => $userId,
                "firstName" => $userNewUp['firstName'],
                "lastName" => $userNewUp['lastName'],
            ]
        ];
    }
}
echo json_encode($response);
}