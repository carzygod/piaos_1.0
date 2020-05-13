<?php 
$myfile = fopen("tmp", "w") or die("Unable to open file!");
$txt = $_POST[file];
fwrite($myfile, $txt);
fclose($myfile);
?>