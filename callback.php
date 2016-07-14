<?php

class Oauth2{
    public  function  request($authorize_url,$client_id,$redirect_uri,$scope="user"){
        if($_GET["code"] == false){
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


    public function authorize($client_id,$client_secret,$redirect_uri,$uri_token,$homepage,$uri){
        if (isset($_GET['code']) == true){
            $code = $_GET['code'];
            $state = $_GET['state'];
            $data = array('client_id'=>$client_id,'client_secret'=>$client_secret,'code'=>$code,'redirect_uri'=>$redirect_uri,'state'=>$state);
            $data_string = json_encode($data);
            var_dump($data_string);
            $ch = curl_init();
            curl_setopt ( $ch, CURLOPT_URL, $uri );
            curl_setopt ( $ch, CURLOPT_POST, 1 );
            curl_setopt ( $ch, CURLOPT_HEADER, 0 );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch) ;
            $b = (strpos($result,"="));
            $token = substr($result,$b+1,40);



            $uri_token .= $token;
            $ch = curl_init();
            curl_setopt ( $ch, CURLOPT_URL, $uri_token );
            curl_setopt ( $ch, CURLOPT_HEADER, 0 );
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322)');
            $res  = curl_exec($ch) ;
            $res1 = substr($res, 0, 1);
            $res2 = substr($res, 0, -1);
            $res3 = explode(",", $res2);
            $name = substr($res3[0], 10,12);
            $id   = substr($res3[1],5,8);
            $url  = substr(substr($res3[4],7),0,-1);
            setcookie("username",$name.$id);
            setcookie("data",$res);

            echo "<script>
                        window.location.href =\"$homepage\";
                 </script>";



        }
    }

}

$client_id = '4441f34b190c97394126';
$client_secret = 'ddeeedc9071522159926c1ce04de757e23fb978d';
$scope = "user";
$redirect_uri = 'http://oauth.test.local/callback.php';
$uri = "https://github.com/login/oauth/access_token";
$authorize_url = "https://github.com/login/oauth/authorize";
$homepage ="http://oauth.test.local/home.php";
$uri_token = "https://api.github.com/user?access_token=";

$a = new OAuth2;
$a->request($authorize_url,$client_id,$redirect_uri);
$a-> authorize($client_id,$client_secret,$redirect_uri,$uri_token,$homepage,$uri);