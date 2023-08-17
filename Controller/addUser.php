<?php
include_once '../Model/Model.php';
include_once '../codeStatus/CodeStatus.php';

$userId = $_POST['userId'];
$lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));
$firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
$status = $_POST['status'];
$role = $_POST['role'];

$errorStatus = 'true';
$code = '100';
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
    echo CodeStatus::myCodeStatus($errorStatus,$code,$error);
    exit();
}

if ($userId !== '"null"') {
    $pdo->upUsers($userId, $lastName, $firstName, $role, $status);
    echo CodeStatus::myCodeStatus($errorStatus,$code,'',$userId);
} else {
    $newIdUser = $pdo->addUser($lastName, $firstName, $role, $status);
    echo CodeStatus::myCodeStatus($errorStatus,$code,'',$newIdUser);
}



