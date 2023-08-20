<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];
$lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));
$firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
$status = $_POST['status'];
$role = $_POST['role'];

$errorStatus = 'true';
$code = '100';
$pdo = new Model();
$user = $pdo->getById($userId);

if (empty(strlen($lastName))) {
    $response[] = ["field" => "lastName", "message" => " Please fill in your last name"];
}
if (empty(strlen($firstName))) {
    $response[] = ["field" => "firstName", "message" => " Please fill in your first name"];

}
if (empty(strlen($role))) {
    $response[] = ["field" => "role", "message" => " Please select a role"];
}

if (empty($user) && $userId !== '"null"') {
    $response[] = ["field" => "noFind", "message" => " No found user"];
}

if (!empty($response)) {
    exit(json_encode(["status" => "false", "error" => $response]));
}

if ($userId == '"null"') {
    $newId = $pdo->addUser($lastName, $firstName, $role, $status);
    $userNew = $pdo->getById($newId);
    if (isset($userNew)) {
        $response = ["status" => "true", "error" => "null", "user" =>
            [
                "id" => $newId,
                "firstName" => $userNew['firstName'],
                "lastName" => $userNew['lastName'],
                "role" => $userNew['role'],
                "status" => $userNew['status'],
            ]
        ];
    }
    else {
        $response = ["status" => 'false', "error" => ["code" => "100", "message" => " failed to add user"]]
        ;
    }
} else {
    $pdo->upUsers($userId, $lastName, $firstName, $role, $status);
    $user = $pdo->getById($userId);
    $response = ["status" => "true", "error" => "null", "user" =>
        [
            "id" => $userId,
            "firstName" => $user['firstName'],
            "lastName" => $user['lastName'],
            "role" => $user['role'],
            "status" => $user['status'],
        ]
    ];
}
echo json_encode($response);


