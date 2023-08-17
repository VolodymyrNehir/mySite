<?php
include_once 'Model/Model.php';
class CodeStatus{

    public function __construct(){

    }
    public static function myCodeStatus($errorStatus='true',$code,$error,$newIdUser=0){
        $pdo = new Model();
        $upGetUser = $pdo->getById($newIdUser);
        $stan = ["status" => $errorStatus, "error" => ["code" => $code, "message" => $error], "user" => $upGetUser[0]];
        return json_encode($stan);
    }
}