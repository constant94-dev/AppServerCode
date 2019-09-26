<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $commentNum = $_GET['commentNum'];

    $commentDeleteSQL = "DELETE FROM accommodation_comment WHERE comment_num ='$commentNum'";

    if (mysqli_query($con, $commentDeleteSQL)) {
        echo "댓글삭제성공";
    } else {
        echo "댓글삭제실패";
    }
}

?>