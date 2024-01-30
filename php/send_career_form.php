<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(404);
    exit();
}

$name = $_POST["name"];
$email = $_POST["email"];
$content = $_POST["content"];
$cv_file = $_FILES["usercvfile"];

$max_file_size_in_bytes = 3145728; // 3mb in bytes

if ($cv_file["size"] > $max_file_size_in_bytes || $cv_file["error"] === UPLOAD_ERR_FORM_SIZE) {
    header('Content-Type: application/json');
    http_response_code(400);

    echo json_encode("Your file must be at most 3mb size.");
    exit();
}

$cv_file_type = pathinfo($cv_file["name"], PATHINFO_EXTENSION);

if (!in_array($cv_file_type, array("png", "pdf", "jpg", "jpeg"))) {
    header('Content-Type: application/json');
    http_response_code(400);

    echo json_encode("Your file must be one of the types: '.png', '.pdf', '.jpg' or '.jpeg'.");
    exit();
}

if ($cv_file["error"] !== UPLOAD_ERR_OK) {
    header('Content-Type: application/json');
    http_response_code(500);

    echo json_encode("Error on uploading your file: ". print_r($cv_file["error"]));
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__.'/../vendor/phpmailer/phpmailer/src/Exception.php';

$recipient_email = "myemail@gmail.com";
$subject = "New career form from $name.";
$cv_to_attach_path = $cv_file["tmp_name"];
$cv_to_attach_name = $cv_file["name"];

ob_start();
include("./career_template.php");
$body = ob_get_contents();
ob_clean();

$phpMailer = new PHPMailer();
$phpMailer->setFrom(ini_get("sendmail_from"));
$phpMailer->Subject= $subject;
$phpMailer->Body = $body;
$phpMailer->isHTML(true);
$phpMailer->addAddress($recipient_email);
$phpMailer->addAttachment($cv_to_attach_path, $cv_to_attach_name);

$email_sent = $phpMailer->send();

if(!$email_sent) {
    header('Content-Type: application/json');
    http_response_code(500);

    echo json_encode("Internal server error.");
    
    file_put_contents(
        "./console.txt",
        PHP_EOL."$phpMailer->ErrorInfo".PHP_EOL,
        FILE_APPEND
    );
} else {
    header('Content-Type: application/json');
    http_response_code(200);
    
    echo json_encode("Email successfully sent.");
}

?>