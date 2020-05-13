<?php
$i  = 0;                 //分割的块编号
$fp  = fopen("wdnmd.png","rb");      //要分割的文件
$file = fopen("split_hash.txt","a");    //记录分割的信息的文本文件，实际生产环境存在redis更合适
while(!feof($fp)){
    $handle = fopen("wdnmd.{$i}.png","wb");
    fwrite($handle,fread($fp,52428));//切割的块大小 5m
    fwrite($file,"wdnmd.{$i}.png\r\n");
    fclose($handle);
    unset($handle);
    $i++;
}
fclose ($fp);
fclose ($file);
echo "ok";
?>