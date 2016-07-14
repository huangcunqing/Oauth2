<?php
namespace  huangcunqing\oauth2;

class Module extends \yii\base\Module{
    public function init()
    {
        parent::init();
        // 从config.php加载配置来初始化模块
    }



//   public function request($authorize_url,$client_id,$redirect_uri,$scope="user"){
//            $req = new oauth2;
//           return $req-> request1($authorize_url,$client_id,$redirect_uri,$scope);
//
//   }
//   public function authorize($client_id,$client_secret,$redirect_uri,$uri,$uri_token){
//            $req = new oauth2;
//           return $req->authorize1($client_id,$client_secret,$redirect_uri,$uri,$uri_token);
//    }
//   public function back1($homepage){
//           $req = new oauth2;
//          return $req-> back1($homepage);
//   }

   public function authorize($authorize_url,$client_id,$redirect_uri,$scope="user",$client_secret,$uri,$uri_token,$homepage){
       $req = new oauth2;
       $req-> request1($authorize_url,$client_id,$redirect_uri,$scope);
       $req->authorize1($client_id,$client_secret,$redirect_uri,$uri,$uri_token);
       $req-> back1($homepage);

   }
}