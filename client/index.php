<?php 

function receiveStreamFile($receiveFile){
    $streamData = isset($GLOBALS['HTTP_RAW_POST_DATA'])? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
    if(empty($streamData)){
        $streamData = file_get_contents('php://input');
    }
    if($streamData!=''){
        $ret = file_put_contents($receiveFile, $streamData, true);
    }else{
    $ret = false;
    }
    return $ret;
}
$file_path = "tmp";
if(file_exists($file_path)){
$str = file_get_contents($file_path);//将整个文件内容读入到一个字符串中
$str = str_replace("\r\n","<br />",$str);
}

$receiveFile = "./upload".$str;
$ret = receiveStreamFile($receiveFile);
//echo json_encode(array('success'=>(bool)$ret));
?>