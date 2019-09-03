<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "php_mailer/PHPMailer.php"; 
require "php_mailer/SMTP.php"; 
require "php_mailer/Exception.php"; 

$mail = new PHPMailer(true);

$userEmail = $_POST['userEmail'];

if(isset($userEmail)){

    try {

        // 서버세팅
        $mail -> SMTPDebug = 2;    // 디버깅 설정
        $mail -> isSMTP();        // SMTP 사용 설정
    
        $mail -> Host = "smtp.gmail.com";                // email 보낼때 사용할 서버를 지정
        $mail -> SMTPAuth = true;                        // SMTP 인증을 사용함
        $mail -> Username = "tkdwns3340@gmail.com";    // 메일 계정
        $mail -> Password = "dkfrpanjdi1*";                // 메일 비밀번호
        $mail -> SMTPSecure = "ssl";                    // SSL을 사용함
        $mail -> Port = 465;                            // email 보낼때 사용할 포트를 지정
        $mail -> CharSet = "utf-8";                        // 문자셋 인코딩
    
        // 보내는 메일
        $mail -> setFrom("tkdwns3340@gmail.com", "운영자");
    
        // 받는 메일    
        $mail -> addAddress($userEmail, "receive");
        
        // 첨부파일
        //$mail -> addAttachment("./test.zip");
        //$mail -> addAttachment("./anjihyn.jpg");
        $mailCode = generateRandomString();
        // 메일 내용
        $mail -> isHTML(true);                                               // HTML 태그 사용 여부
        $mail -> Subject = "축하합니다! 계정을 성공적으로 생성하셨습니다";              // 메일 제목
        $mail -> Body = "해당 인증코드를 입력해주세요 [<b>$mailCode</b>] <br><br>감사합니다.";    // 메일 내용
    
        // Gmail로 메일을 발송하기 위해서는 CA인증이 필요하다.
        // CA 인증을 받지 못한 경우에는 아래 설정하여 인증체크를 해지하여야 한다.
        $mail -> SMTPOptions = array(
            "ssl" => array(
                  "verify_peer" => false
                , "verify_peer_name" => false
                , "allow_self_signed" => true
            )
        );
        
        // 메일 전송
        $mail -> send();
        
        echo "Message has been sent ".$mailCode;
    
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error : ", $mail -> ErrorInfo;
    }
}

// 랜덤 문자열 생성 함수
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>