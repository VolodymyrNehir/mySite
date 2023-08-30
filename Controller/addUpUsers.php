<?php
include_once '../Model/Model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (isset($_POST['userId']) && is_numeric($_POST['userId'])){
        $userId = $_POST['userId'];
    } else{
        $userId = '';
    }
    if (isset($_POST['lastName'])){
        $lastName = trim(filter_var($_POST['lastName'],FILTER_SANITIZE_STRING));
    } else {
        $lastName = '';
    }
    if (isset($_POST['firstName'])){
        $firstName =  trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
    } else {
        $firstName = '';
    }
    if (isset($_POST['status'])){
        $status = $_POST['status'];
    } else {
        $status = '';
    }
    if (isset($_POST['role'])){
        $role = $_POST['role'];
    } else {
        $role = '';
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