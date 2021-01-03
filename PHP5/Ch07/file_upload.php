<?
//file_upload.php
$archive_dir = "/Inetpub/wwwroot/beginning_php5/ch07/docs";
function upload_form() {
   global $PHP_SELF;
?>
<form method="POST" enctype="multipart/form-data" 
   action="<? echo $PHP_SELF ?>">
   <input type="hidden" name="action" value="upload">
   Upload file!
   <input type="file" name="userfile">
   <input type="submit" name="submit" value="upload">
</form>
<?
}

function upload_file() {
   global $userfile, $userfile_name, $userfile_size, 
         $userfile_type, $archive_dir, $WINDIR;

   if(isset($WINDIR)) $userfile = str_replace("\\\\","\\", $userfile);
   
   $filename = basename($userfile_name);
   
   if($userfile_size <= 0) die ("$filename is empty.");

   if(!@copy($userfile, "$archive_dir/$filename"))
      die("Can't copy $userfile_name to $filename.");
   
   if(isset($WINDIR) && !@unlink($userfile))
      die ("Can't delete the file $userfile_name.");

   echo "$filename has been successfully uploaded.<br>";
   echo "Filesize: " . number_format($userfile_size) . "<br>";
   echo "Filetype: $userfile_type<br>";
}
?>
<html>
<head><title>file upload</title></head>
<body>
<?
if($action == 'upload') upload_file();

else upload_form();
?>
</body>
</html>
