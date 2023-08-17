<?php
include_once "../Model/Model.php";

$form =$_POST['form'];


$pdo = new Model();

foreach ($form['userId'] as $user){
    $pdo->setAction($user,$form['select'] );
}
echo json_encode($pdo->selectUsers());