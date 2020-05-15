<?php
    //上传文件-------------------------------------------------------------
    //var_dump($_FILES);
    /*'filename' => 
    array (size=5)
      'name' => string '7730-15042G60S6-52.jpg' (length=22)
      'type' => string 'image/jpeg' (length=10)
      'tmp_name' => string 'D:\wamp64\tmp\phpE94A.tmp' (length=25)
      'error' => int 0
      'size' => int 338411*/
    //获取文件信息
    $fileinfo=$_FILES['file'];
    //文件上传路径
    $path="./upload/";
    //大小 0不限止
    $maxsize=0;
    $ext=pathinfo($fileinfo['name'],PATHINFO_EXTENSION);
    
    //生成随机文件名
    do{
    
        $newname=$_FILES['file'][name];
    
    }while(file_exists($path.$newname));
    
    //判断是否上传成功
    if(is_uploaded_file($fileinfo['tmp_name'])){
        if(move_uploaded_file($fileinfo['tmp_name'],$path.$newname)){
          //  echo "上传成功！";
        }else{
            die("移动失败！");
        }
    
    }else{
        die("未知错误！请重试");
    
    }
    

    //上传文件-------------------------------------------------------------
    			 session_start();
    $_SESSION['fname']=$_FILES['file'][name];
    	header("location:postfile.php");
    //	echo($_SESSION['fname']);
?>