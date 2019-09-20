<?php

$target_dir = "images/";
$totalFiles = $_REQUEST['totalFiles'];
$successUpload = 0;


for($i=1; $i <= $totalFiles; $i++){
    $fileName = 'uploadFile_'.$i;
    if(move_uploaded_file($_FILES[$fileName]['tmp_name'],$target_dir.$_FILES[$fileName]['name'])){
        $successUpload += 1;
        $uploadFiles .= $target_dir.$_FILES[$fileName]['name']." ";
    }
}

echo $uploadFiles;


?>