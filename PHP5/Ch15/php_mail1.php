<html>
<head>
<title>PHP Mail Functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="Javascript1.2"><!-- // load htmlarea
_editor_url = "http://localhost/php5/Chapter15/htmlarea/"; // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// --></script>

</head>

<body bgcolor="#FFFFFF">
<table width="100%" border="0" cellpadding="10">
  <tr>
    <td>
      <h2>Using PHP to Send Email</h2>
<?php

//set the default directory for files
$default_dir = "C:\\tmp\\_wl_mara_tmp";

//check to see if the form was posted
if (!empty($_POST)) {
	//capture the send_name
	$sender_name = $_POST['first_name'] . " " . $_POST['last_name'];

	//compose and send plain text, HTML, or multi-part message
	//or return error message

	//check to see what kind of email is being sent
	if ($_POST['html_or_text'] == "html") {

		//while there are filenames in the list keep adding MIME sections
		if (count($_POST['attachments']) > 0) {

			//initialize the count for content
			$cnt = 0;
			
			//create a boundary marker
			$boundary = "0000_PHP5_0000";

			//run through all the files in the $attachments array
			for ($i = 0; $i < count($_POST['attachments']); $i++) {

				$fp = fopen($default_dir . "\\" . $_POST['attachments'][$i],"rb");
				$file_name = basename($_POST['attachments'][$i]);
				$content[$cnt] = fread($fp,filesize($default_dir . "/" . $_POST['attachments'][$i])); 
				$files_attached = "";
				$files_attached.="--$boundary\n"  
				."Content-Type: image/jpeg; name=\"$file_name\"\n"  
				."Content-Transfer-Encoding: base64\n"  
				."Content-Disposition: inline; filename=\"$file_name\"\n\n"  
				.chunk_split(base64_encode($content[$cnt]))."\n";  
				$cnt++;
				fclose($fp);
			}

			$from_header = "From: $sender_name <$_POST[from]>\nCC: $_POST[cc]\nBCC: $_POST[bcc]\nReply-To: $_POST[from]\n";
			$salutation = $_POST['salutation'] . "\n\n";
			$body = $salutation . $_POST['body'] . "\n\n" . $_POST['regards'];

			// Create the main MIME header, then add the body message and the files attached
			$files_attached .= "--".$boundary."\n";  
			$add_header = "";
			$add_header .="MIME-Version: 1.0\n"	."Content-Type: multipart/mixed; boundary=\"$boundary\"; Message-ID: <".md5($_POST['from'])."@example.com>";
			$mail_content="--".$boundary."\n"  
			."Content-Type: text/plain; charset=\"iso-8859-1\"\n"  
			."Content-Transfer-Encoding: 8bit\n\n"  
			.$body."\n\n".$files_attached;

			$body = $mail_content; 
		} else {

			//for HTML email
			$salutation = $_POST['salutation'];
			$salutation = $salutation . "<br><br>";
			$body = $salutation . stripslashes($_POST['body']) . "<br><br>" . $_POST['regards'];
			
			//Set HTML Headers
			$from_header = "From: $sender_name <$_POST[from]>\nCC: $_POST[cc]\nBCC: $_POST[bcc]\nReply-To: $_POST[from]\n";
			$add_header = "MIME-Version: 1.0\n";
			$add_header .= "Content-type: text/html; charset=iso-8859-1\n";
			}

	} else {

		//for plain text with no attachments
		$from_header = "From: $sender_name <$_POST[from]>\nCC: $_POST[cc]\nBCC: $_POST[bcc]\nReply-To: $_POST[from]\n";
		$salutation = $_POST['salutation'];
		$salutation = $salutation . "\n\n";
		$body = $_POST['body'];
		$body = $salutation . $body . "\n\n" . $_POST['regards'];
	}
	
$to = "$_POST[to]";

	//gather up all the To: addresses into one variable
	
	
	do{
		next($_POST);
	}while (key($_POST) !== 'to');
			for ($i = 1; $i <=7; $i++) {
				$next = next($_POST);
				if(!empty($next)){
$to = $to . ", " . $next;
				}
			}

	
	//do a minimal check for email address, then send mail
	if (strpos($_POST['to'],"@") >= 0) {
		
		//Send the mail	
		echo "<br>To: $to<p>";
		echo "Subject: $_POST[subject]<p>";
		echo "Body: $body<p>";
		echo "$from_header<p>";
		echo "$add_header<p>";
		if(!isset($add_header)){
			if (mail($to, $_POST['subject'], $body)){
				echo "<h3>Your email has been sent</h3>";
		    } else {
			echo "An error occurred, and your email has not been sent";
		    }
		}else if (mail($to, $_POST['subject'], $body, "$from_header". "$add_header")) {
			echo "<h3>Your email has been sent</h3>";
		} else {
			echo "An error occurred, and your email has not been sent";
		}

	} else {
		echo "A bad email address was encountered";
		
	}

//display the email sending form if the form is not posted
} else {

?>

	<form method="POST" action="php_mail1.php">
	<input type="hidden" name="posted" value="true">
        <table width="100%" border="1">
          <tr>
            <td width="16%" valign="top"><font face="Arial, Helvetica, sans-serif" size="-1"><b>Your 
              Name:</b></font></td>
            <td width="84%"><font size="-1" face="Arial, Helvetica, sans-serif"><b>First</b></font> 
              <input type="text" name="first_name">
              <b><font size="-1" face="Arial, Helvetica, sans-serif">Last</font></b> 
              <input type="text" name="last_name">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">From:</font></b></td>
            <td width="84%"> 
              <input type="text" name="from">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">To:</font></b></td>
            <td width="84%"> 
              <input type="text" name="to">
              <input type="text" name="to01">
              <input type="text" name="to02">
              <input type="text" name="to03">
              <input type="text" name="to04">
              <input type="text" name="to05">
              <input type="text" name="to06">
              <input type="text" name="to07">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">CC:</font></b></td>
            <td width="84%"> 
              <input type="text" name="cc">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">BCC:</font></b></td>
            <td width="84%"> 
              <input type="text" name="bcc">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">Subject:</font></b></td>
            <td width="84%"> 
              <input type="text" name="subject">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">Attachments:<br>
              Use Ctrl-Click to remove selections</font></b></td>
            <td width="84%">
              <select name="attachments[]" size="4" multiple>
<?php

//fill the list box with available filenames
if(!($dp = opendir($default_dir))) {
	die("Cannot open $default_dir.");
} else {
	while($file = readdir($dp)) {
		if($file != '.' && $file != '..') {

?>
		<option value="<?php echo $file; ?>"><?php echo $file; ?></option>
<?php

		}
	}
closedir($dp);
}
?>

              </select>
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">Salutation:</font></b></td>
            <td width="84%"> 
              <input type="text" name="salutation">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">Body:</font></b></td>
            <td width="84%"> 
              <textarea name="body" cols="40" rows="10"></textarea>
<script language="javascript1.2">
editor_generate('body');
</script>
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top"><b><font face="Arial, Helvetica, sans-serif" size="-1">Regards:</font></b></td>
            <td width="84%"> 
              <input type="text" name="regards">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top">&nbsp;</td>
            <td width="84%"> <font face="Arial, Helvetica, sans-serif"><b><font size="-1">HTML 
              or Attached Files 
              <input type="radio" name="html_or_text" value="html">
              Plain Text 
              <input type="radio" name="html_or_text" value="text" checked>
              <input type="submit" name="Submit" value="Send Email">
              </font> </b> </font> </td>
          </tr>
        </table>
</form>
<?php
}
?>
    </td>
  </tr>
</table>
</body>
</html>
