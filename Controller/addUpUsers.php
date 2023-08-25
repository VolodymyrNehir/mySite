<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];
$lastName = trim($_POST['lastName']);
$firstName = trim($_POST['firstName']);
$status = $_POST['status'];
$role = $_POST['role'];

$errorStatus = 'true';
$code = '100';
$pdo = new Model();
$user = $pdo->getById($userId);

if (!preg_match('/^[A-Za-z0-9\-]+$/', $lastName)) {
    $response[] = ["field" => "lastName", "message" => " Incorrect characters are entered"];
}
if (!preg_match('/^[A-Za-z0-9\-]+$/', $firstName)) {
    $response[] = ["field" => "firstName", "message" => " Incorrect characters are entered"];
}
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
    $newId = $pdo->addUser($lastName, $firstName, $role, $status);
    $userNew = $pdo->getById($newId);
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
    $pdo->upUsers($userId, $lastName, $firstName, $role, $status);
    $userNewUp = $pdo->getById($userId);
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
