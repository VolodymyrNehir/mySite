<?php
include_once "../Model/Model.php";
include_once "../codeStatus/CodeStatus.php";

$form =$_POST['form'];


$pdo = new Model();
foreach ($form['userId'] as $user){
    $res =  $pdo->setAction($user,$form['select']);
   $arrStatus[] = CodeStatus::myStatusCodeUsers($user,$res,'100','failed to provide status');
}
echo json_encode($arrStatus);
