<?php
if (isset($_POST["dd"])) {
	$data= json_decode($_POST["dd"]);

	$from= $data->from;
	$subject= $data->subject;
	$to= $data->to;
	$message= $data->message;

	$headers= "MIME-Version: 1.0\r\n";
	$headers.= "From: ". $from ."\r\n";
	$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	foreach ($to as $campaign) {
		$name= $campaign->name;
		$email= $campaign->email;

		//	TEMPLATE
		$template= '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/><title>'. $subject .'</title></head><body style="margin: 0;"><table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="padding: 84px 63px 28px 63px; background-color: #171a19;"><tr><td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0" style="min-width: 280px; width: 100%; max-width: 494px; margin: 0 auto;"><tr><td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 21px;"><tr><td align="left" valign="top"><a href="https://yahiarefaiea.com" target="_blank" style="display: block; text-decoration: none; width: 100px;"><img src="https://yahiarefaiea.com/campaigns/includes/images/signature.gif" height="28px" style="display: block; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: 400; font-size: 14px; line-height: 28px; color: #fff; white-space: nowrap;" alt="Yahia Refaiea signature" title="Yahia Refaiea signature"/></a></td><td align="right" valign="top"><a href="https://yahiarefaiea.com" target="_blank" style="display: block; text-decoration: none; width: 100px;"><img src="https://yahiarefaiea.com/campaigns/includes/images/identity.png" height="10px" style="display: block; margin: 9px 0; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: 400; font-size: 14px; line-height: 10px; color: #e0a458; white-space: nowrap;" alt="Yahia Refaiea identity" title="Yahia Refaiea identity"/></a></td></tr><tr><td align="left" valign="top" style="padding-top: 42px;">';

		$template.= '<span style="display: block; font-family: Georgia, sans-serif; font-weight: 700; font-size: 28px; line-height: 42px; color: #fff;">'. $subject .'</span>';

		$template.= '</td></tr></table><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td align="left" valign="top"><span style="display: block; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: 400; font-size: 14px; line-height: 35px; color: #ddd;">';

		$template.= '<span style="display: block; margin-bottom: 7px;">Hi '. $name .'!</span>';

		$template.= $message;

		$template.= '</span></td></tr></table></td></tr></table></td></tr></table></body></html>';

		//	SEND MAILS
		mail($email,"Yahia Refaiea - ". $subject,$template,$headers);
	}

	//	SEND REPORT
	mail("me@yahiarefaiea.com","Campaign Report - ". $subject,"Message:<br>". $message ."<br>To:<br>". json_encode($to),$headers);

	//  RESPONSE
	$response_array['status']= 'success';
	echo json_encode($response_array);
}
?>
