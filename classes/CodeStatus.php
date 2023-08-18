<?php
include_once '../Model/Model.php';
class CodeStatus{

    public function __construct(){

    }
    public static function myCodeStatus($errorStatus='true',$code,$error,$newIdUser = 0){
        $pdo = new Model();
        $user = '';
       $user = $pdo->getById($newIdUser);
        $stan = ["status" => $errorStatus, "error" => ["code" => $code, "message" => $error,"user" => $user], "user" => $user

        ];
        return json_encode($stan);
    }

    public static function myStatusCodeUsers($user,$pdo,$code,$error){
            if ($pdo == false){
               return json_decode(self::myCodeStatus('false',$code,$error,$user));
            } else {
                return json_decode(self::myCodeStatus('true','','',$user));
            }
    }
}