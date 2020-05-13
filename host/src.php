<?php 
/** php 发送流文件 
* @param String $url 接收的路径 
* @param String $file 要发送的文件 
* @return boolean 
*/ 
$u='http://debug.sidcloud.cn/filesrc/index.php';
$f=$_FILES['file'] ;
sendStreamFile($u,$f);
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
    $ret = json_decode($response, true); 
    return $ret['success']; 
  }else{ 
    return false; 
  } 
} 
$ret = sendStreamFile('http://debug.sidcloud.cn/filesrc/index.php','send.txt');
var_dump($ret); 
?>