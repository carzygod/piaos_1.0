<?php
    			 session_start();
$i  = 0;                 //分割的块编号
$fp  = fopen("./upload/".$_SESSION['fname'],"rb");      //要分割的文件
$file = fopen($_SESSION['fname'].".info","a");    //记录分割的信息的文本文件，实际生产环境存在redis更合适
$filename="";
while(!feof($fp)){
    $handle = fopen("./".$_SESSION['fname'].$i,"wb");
    fwrite($handle,fread($fp,52428));//切割的块大小 5m
    fwrite($file,"./upload/".$_SESSION['fname'].$i."\r\n");
    
    fclose($handle);
    unset($handle);
    $i++;
}
fclose ($fp);
fclose ($file);

for($emmm=0;$emmm<=$i;$emmm++){
    $filename="./".$_SESSION['fname'].$emmm;
    $post_data = array(
  'file' =>$filename
);
    send_post("http://debug.sidcloud.cn/filesrc/head.php",$post_data);
$u='http://debug.sidcloud.cn/filesrc/index.php';
    echo("./".$filename."<br>");
    sendStreamFile($u,"./".$filename);
}


//$f=$_FILES['file'] ;



//send_post("http://debug.sidcloud.cn/filesrc/head.php",$post_data);

//sendStreamFile($u,"./index.html");

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

$ret = sendStreamFile('http://localhost/fdipzone/receiveStreamFile.php', 'send.txt');

var_dump($ret);


function send_post($url, $post_data) {
 
  $postdata = http_build_query($post_data);
  $options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-type:application/x-www-form-urlencoded',
      'content' => $postdata,
      'timeout' => 15 * 60 // 超时时间（单位:s）
    )
  );
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
 
  return $result;
}

?>
