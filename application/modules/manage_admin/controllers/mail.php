<?php
	function filter_string($str){
	$str = html_entity_decode($str);
	$str = stripslashes($str);
	$str = stripslashes($str);
	$str = str_replace("\\r","\r",str_replace("\\n","\n",$str));
	//$str =  str_replace("\\r\\n", "\r\n",mysql_real_escape_string(trim($str)));
	return $str;
}

$to = "ragineep1@gmail.com";
$subject = "Test Email";
//$link="http://10.115.254.213:8080/data_signing/verifySignData?signData=$signData&publicKey=$publicKey&digitalSignature=$digitalSignature";
//$message = "hello Mam, This is test email-2. <a href='".$link."'>Varify</a>";
$message = "<table><tr><td>raginee</td></tr></table>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; // for html
// More headers
$headers .= 'From: <ragineep1@gmail.com>' . "\r\n";
//$headers .= 'Cc: fromcc@example.com' . "\r\n";

if(mail($to,$subject,filter_string($message),$headers)){
	echo "sent";
}else
{
	echo "fail";
}
?>