<?php
namespace  huangcunqing\Oauth2;

class Module extends \yii\base\Module{
    public function init()
    {
        parent::init();
        // 从config.php加载配置来初始化模块
    }



   public function request($authorize_url,$client_id,$redirect_uri,$scope="user"){
            $req = new oauth2;
            $req-> request1($authorize_url,$client_id,$redirect_uri,$scope);

   }
   public function authorize($client_id,$client_secret,$redirect_uri,$uri,$uri_token){
            $req = new oauth2;
            $req->authorize1($client_id,$client_secret,$redirect_uri,$uri,$uri_token);
    }
   public function back1($homepage){
        echo "<script> window.location.href =\"$homepage\"; </script>";
   }
//   public function re($email,$password,$username,$name="user"){
//            $res = new resit;
//           return $res->reg($email,$password,$username,$name);
//    }

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