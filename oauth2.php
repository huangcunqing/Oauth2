<?php
namespace  huangcunqing\oauth2;
class oauth2{
// 发送一个请求
    public  function  request1($authorize_url,$client_id,$redirect_uri,$scope="user"){
        if(!isset($_GET["code"] )){
            srand((double)microtime()*1000000);//create a random number feed.
            $ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,@,#,%,a,b,_";
            $list=explode(",",$ychar);
            $authnum = "";
            for($i=0;$i<8;$i++){
                $randnum=rand(0,35); // 10+26;
                $authnum.=$list[$randnum];
            }
            $state =  $authnum;
            echo "<script> window.location.href = \"$authorize_url\"+\"?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=$scope&state=$state\" </script>";
        }

    }


    //授权完成取得令牌
    public function authorize1($client_id,$client_secret,$redirect_uri,$uri,$uri_token){
        if (isset($_GET['code']) == true){

            $code = $_GET['code'];
            $state = $_GET['state'];
            $data = array('client_id'=>$client_id,'client_secret'=>$client_secret,'code'=>$code,'redirect_uri'=>$redirect_uri,'state'=>$state);
            $ch = curl_init();
            curl_setopt ( $ch, CURLOPT_URL, $uri );
            curl_setopt ( $ch, CURLOPT_POST, 1 );
            curl_setopt ( $ch, CURLOPT_HEADER, 0 );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322)');
            $result = curl_exec($ch);
//            var_dump($result);
            $b = (strpos($result,"="));
            $token = substr($result,$b+1,40);
//            var_dump($token);
//            携带令牌访问取得用户信息
            $uri_token .="?access_token=".$token;
            $ch = curl_init();
            curl_setopt ( $ch, CURLOPT_URL, $uri_token );
            curl_setopt ( $ch, CURLOPT_HEADER, 0 );
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322)');
            $res  = curl_exec($ch) ;
            $res2 = substr($res, 0, -1);
            $res3 = explode(",", $res2);
            $name = substr($res3[0], 10,12);
            $id   = substr($res3[1],5,8);
            setcookie("username",$name.$id);
            setcookie("data",$res);
        }
    }


    public function back1($homepage){
        echo "<script> window.location.href =\"$homepage\"; </script>";

    }

}

//$client_id = '4441f34b190c97394126';
//$client_secret = 'ddeeedc9071522159926c1ce04de757e23fb978d';
//$scope = "user";
//$redirect_uri = 'http://oauth.test.local/callback.php';
//$uri = "https://github.com/login/oauth/access_token";
//$authorize_url = "https://github.com/login/oauth/authorize";
//$homepage ="http://oauth.test.local/home.php";
//$uri_token = "https://api.github.com/user";
//
//$a = new OAuth2;
//$a->request1($authorize_url,$client_id,$redirect_uri);
//$a->authorize1($client_id,$client_secret,$redirect_uri,$uri,$uri_token);
//$a->back1($homepage);