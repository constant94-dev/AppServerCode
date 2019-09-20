<?php
$target_dir = "images/";
$target_file_name = $_FILES['upload']['name'];
$target_file_error = $_FILES['upload']['error'];
$name = $_POST['name'];

if (isset($_FILES['upload']['name'])) {
    if(move_uploaded_file($_FILES['upload']['tmp_name'],$target_dir.$target_file_name)){
        echo $target_dir.$target_file_name;
    } else {
        echo "클라이언트에서 전달한 파일은 있지만 업로드 실패!";    
    }
} else {
    echo "클라이언트에서 전달한 파일 없음";
}

//echo "??";
?>
