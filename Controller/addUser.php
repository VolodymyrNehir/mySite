<?php
include_once '../Model/Model.php';

$userId = $_POST['userId'];
$lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));
$firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
$status = $_POST['status'];
$role = $_POST['role'];




$errorStatus = 'true';
$error = '';
$code = '100';

$pdo = new Model();
$getUser = $pdo->getById($userId);

if (empty(strlen($userId))) {
    $errorStatus = 'false';
}
else
    if (empty(strlen($lastName))) {
        $errorStatus = 'false';
        $error = 'field last Name is not filled';
    } else
        if (empty(strlen($firstName))) {
            $errorStatus = 'false';
            $error = 'field first Name is not filled';
        } else

            if (empty(strlen($role))) {
                $errorStatus = 'false';
                $error = 'field role is not filled';
            }
if ($userId !== '"null"' && empty($getUser)) {
    $errorStatus = 'false';
    $error = 'no found user';
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
    $newIdUser = $pdo->addUser($lastName, $lastName, $role, $status);
    $upGetUser = $pdo->getById($newIdUser);
    $stan = ["status" => $errorStatus, "error" => ["code" => $code, "message" => $error], "user" => $upGetUser[0]];
    echo json_encode($stan);
}



