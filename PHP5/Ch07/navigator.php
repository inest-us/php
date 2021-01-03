<?php
//navigator.php
include "common_php5.inc.php";
function mkdir_form() {
   global $dir;
?>
<center>
<form method="POST" 
   action="<?php echo "$_SERVER[PHP_SELF]?action=make_dir&dir=$dir"; ?>">
<input type="hidden" name="action" value="make_dir">
<input type="hidden" name="dir" value="<? echo $dir ?>">

<?php
echo "<strong>$dir</strong>"
?>

<br>
<input type="text" name="new_dir" size="10">
<input type="submit" value="Make Dir" name="Submit">

</form>
</center>
<?php
}
function make_dir() {
   global $dir;
   if(!@mkdir("$dir/$_POST[new_dir]", 0700)) {
      error_message("Can't create the directory $dir/$_POST[new_dir].");
   }
   html_header();
   dir_page();
   html_footer();
}
function display() {
   global $text_file_array, $image_file_array;
   $extension = array_pop(explode(".", $_GET['filename']));
   if(in_array($extension, $text_file_array)) {
      readfile("$_GET[dir]/$_GET[filename]");
   }
   else if(in_array($extension, $image_file_array)) {
               echo "<img src=\"$_GET[dir]/$_GET[filename]\">";
   }
   else echo "Cannot be displayed. $_GET[dir]/$_GET[filename] has not been 
               recognized as a text file, nor as a valid image file. ";
}
function dir_page() {
   global $dir, $default_dir, $default_filename;
   
   if($dir == '') {
      $dir = $default_dir;
   }

   if (isset($_GET['dir'])) {
	$dir = $_GET['dir'];
   }

   $dp = opendir($dir);

?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
   while($file = readdir($dp)) $filenames[] = $file;
   sort($filenames);
   for($i = 0; $i < count($filenames); $i++)
   {
      $file = $filenames[$i];
   if($dir == $default_dir && ($file == "." || $file == ".."))
         continue;
      if(is_dir("$dir/$file") && $file == ".")
         continue;
      if(is_dir("$dir/$file")) {
         if($file == ".."){
            $current_dir = basename($dir);
            $parent_dir = ereg_replace("/$current_dir$","",$dir);
            echo "<tr><td width=\"100%\" nowrap>
               <a href=\"$_SERVER[PHP_SELF]?dir=$parent_dir\">$file/
               </a></td></tr>\n";
         }         
         else echo "<tr><td width=\"100%\" nowrap>
                    <a href=\"$_SERVER[PHP_SELF]?dir=$dir/$file\">
                       $file/</a></td></tr>\n";
      }
      else echo "<tr><td width=\"100%\" nowrap>
            <a href=\"$_SERVER[PHP_SELF]?action=display&dir=$dir&filename=$file\"
               target=\"_blank\">$file</a></td></tr>\n";
   }
?>
</table>
<?php
   mkdir_form();
}
if(empty($dir) || !ereg($default_dir, $dir)) {
   $dir = $default_dir;
}
if (!empty($_POST['action'])) {
   $action = $_POST['action'];
}
if (!empty($_GET['action'])) {
   $action = $_GET['action'];
}

switch ($action) {
   case "make_dir":
      make_dir();
      break;
   case "display":
      display();
      break;
   default:
      html_header();
      dir_page();
      html_footer();
      break;
}
?>
