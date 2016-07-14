<?php
namespace  huangcunqing\resit;

class Module extends \yii\base\Module{
    public function init()
    {
        parent::init();
        // 从config.php加载配置来初始化模块
    }

   public function re($email,$password,$username,$name="user"){
            $res = new resit;
           return $res->reg($email,$password,$username,$name);
    }

//   public function entry($username,$password){
//
//       $data = array("username"=>$username,"password"=>$password);
//       $data_string = json_encode($data);
//       $ch = curl_init('http://backend.userauth.local/login');
//       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//       curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//       curl_setopt($ch, CURLOPT_HTTPHEADER,'Content-Type: application/json');
//
//
//       $result = curl_exec($ch);
//       curl_close($ch);
//   }

}