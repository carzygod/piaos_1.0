<?php
sendStreamFile("http://debug.sidcloud.cn/client/index.php","./emp.php");
function sendStreamFile($url, $file){
    if(file_exists($file)){
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'content-type:application/x-www-form-urlencoded',
                'content' => file_get_contents($file)
            )
        );
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
     //   $ret = json_decode($response, true);
    //    return $ret['success'];

    }else{

     //   return false;

    }

}
?>