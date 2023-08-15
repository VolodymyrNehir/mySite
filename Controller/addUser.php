<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];
$lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));
$firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
$status = $_POST['status'];
$role = $_POST['role'];


$errorStatus = 'true';
$code = '100';
$error = ["lastName"=>'',"firstName"=>'',"role"=>''];
$pdo = new Model();
$getUser = $pdo->getById($userId);

if (empty(strlen($userId))) {
    $errorStatus = 'false';
}

if (empty(strlen($lastName))) {
    $errorStatus = 'false';
    $error["lastName"] = " field last Name is not filled";
}

if (empty(strlen($firstName))) {
    $errorStatus = 'false';
    $error["firstName"] = " field first Name is not filled";
}

if (empty(strlen($role))) {
    $errorStatus = 'false';
    $error["role"] = " field role is not filled";
}
if ($userId !== '"null"' && empty($getUser)) {
    $errorStatus = 'false';
        $error['noFound'] = "no found user";
}

if ($errorStatus == 'false') {
    $stan = ["status" => $errorStatus, "error" => ["code" => $code, "message" => $error]];
    echo json_encode($stan);
    exit();
}

if ($userId !== '"null"') {
    $pdo->upUsers($userId, $lastName, $firstName, $role, $status);
    $upGetUser = $pdo->getById($userId);
    $stan = ["status" => $errorStatus, "error" => ["code" => $code, "message" => $error], "user" => $upGetUser[0]];
    echo json_encode($stan);
} else {
    $newIdUser = $pdo->addUser($lastName, $firstName, $role, $status);
    $upGetUser = $pdo->getById($newIdUser);
    $stan = ["status" => $errorStatus, "error" => ["code" => $code, "message" => $error], "user" => $upGetUser[0]];
    echo json_encode($stan);
}



