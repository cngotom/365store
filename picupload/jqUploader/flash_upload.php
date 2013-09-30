<?php
//error_reporting(E_ALL);
echo "flash_OK";
$fileName = ROOT_PATH . "\\images\\temp\\" . $_GET['newfileName'] . ".jpg";

//copy($_FILES['Filedata']['tmp_name'],"good.jpg");

copy($_FILES['Filedata']['tmp_name'],$fileName);

$result = array("code"=>"0","msg"=>"success","fileName"=>"\\jqUploader1023\\".$fileName);
