<?php
include_once '../Model/Model.php';
include_once '../codeStatus/CodeStatus.php';

$userId = $_POST['userId'];

$pdo = new Model();
foreach ($userId as $user) {
  $res =  $pdo->deleteUsers($user);
   $arrStatus[] =  CodeStatus::myStatusCodeUsers($user, $res, '100', 'Not found');
}
echo json_encode($arrStatus);



