<?php

$name = $_POST['inputName'];
$email = $_POST['inputEmail'];
$subject = $_POST['inputSubject'];
$comment = $_POST['inputComment'];


$to = "support@kooapps.com";

$body = "<p><b>From:</b> " . $email . "</p>";
$body .= "<p><b>Subject:</b> " . $subject . "</p>";
$body .= "<p><b>Query:</b> <br />" . nl2br($comment) . "</p>";

$headers = "From: " . $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";

if (@mail($to, $subject, $body, $headers)) {
    echo true;
}else {
    echo false;
}
?>
