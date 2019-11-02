<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 GET 일 때
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $lastMessage = $_GET['lastMessage'];
    $chatRoomNum = $_GET['chatRoomNum'];

    $chatRoomUpdateSQL = "UPDATE accommodation_chatroom SET chatroom_lastmessage = '$lastMessage' WHERE chatroom_num = '$chatRoomNum'";

    if (mysqli_query($con, $chatRoomUpdateSQL)) {
        echo "마지막메시지수정성공";
    } else {
        echo "마지막메시지수정실패";
    }

}

?>