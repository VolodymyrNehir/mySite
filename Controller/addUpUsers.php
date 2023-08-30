<?php
include_once '../Model/Model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $userId = '';
    $lastName = '';
    $firstName = '';
    $status = '';
    $role = '';

    if (isset($_POST['userId'])){
        $userId = (int) $_POST['userId'];
    }
    if (isset($_POST['lastName'])){
        $lastName = htmlspecialchars(trim(strip_tags($_POST['lastName'])),ENT_QUOTES);
    }
    if (isset($_POST['firstName'])){
        $firstName =  htmlspecialchars(trim(strip_tags($_POST['firstName'])),ENT_QUOTES);
    }
    if (isset($_POST['status'])){
        $status = (int) $_POST['status'];
    }
    if (isset($_POST['role'])){
        $role = (int) $_POST['role'];
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
                "firstName" => html_entity_decode($userNew['firstName'],ENT_QUOTES),
                "lastName" => html_entity_decode($userNew['lastName'],ENT_QUOTES),
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
                "firstName" => html_entity_decode($userNewUp['firstName'],ENT_QUOTES),
                "lastName" => html_entity_decode($userNewUp['lastName'],ENT_QUOTES),
            ]
        ];
    }
}
echo json_encode($response);
}