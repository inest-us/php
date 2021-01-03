<html>
<head><title>Welcome to Web Text Editor</title></head>
<body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="posted" value="true">
<?php

require("common_php5_02.inc.php");

//specify the default directory
$dir = "C:\Program Files\Apache Group\Apache2\htdocs\PHP5\Ch7";

if (isset($_POST['save_edited_file'])) {
	$action_chosen = "save_file";
} elseif (isset($_POST['create_new_file'])) {
	$action_chosen = "save_file"; 
} elseif (isset($_POST['edit_existing_file'])) {
	$action_chosen = "edit_existing_file"; 
}

switch ($action_chosen) {
 
  case "save_file";

		if (file_exists("$dir/$_POST[filename]")) {
		   echo "<script>result = confirm(\"Overwrite '$dir/$_POST[filename]'?\"); 
		   if(!result) history.go(-1);</script>";
		}
		if ($file = fopen("$dir\\$_POST[filename]", "w")) {
		   fputs($file, $_POST['filebody']);
		   fclose($file);
		} else {
			error_message("Can't save file $dir/$_POST[filename].");
		}
		//display the main buttons
		?>
		<table border="1" align="center"><tr><td>
		<strong>Create (or Overwrite) New File or Edit Existing File</strong>
		</td></tr>
		<tr><td>
		<input type="submit" name="create_new_file" value="Create New File">
		<input type="text" name="filename" value="new.txt">
		</td></tr>
		<tr><td>
		<input type="submit" name="edit_existing_file" value="Edit Existing File">
		<select name="existing_file">
		<?php

		if($dp = opendir($dir)) {
			while($file = readdir($dp)) {
				if($file !== '.' && $file !== '..' &&
                        is_file($dir."/".$file)) {
				?>
				<option value="<?php echo $file; ?>">
                        <?php echo $file; ?></option>
				<?php
			}
		   }
		   } else {
               error_msg("Can't open directory $dir.");
		   }
		
		closedir($dp);

		?>
		</select>
		</td></tr></table>
		<?php

		break;
case "edit_existing_file";

		$filepath = "$dir/$_POST[existing_file]";
		$filebody = implode("",file($filepath));
		$file_info_array = file_info("$filepath");
		
		if ($file_info_array["filetype"] != "text") {
			$filebody = $filepath . " is not a text file. Can't edit.";
			$editable = 0;
		} else {
			$editable = 1;
		}
		?>
		<table border="1" width="70%" align="center">
		<tr><th width="100%" colspan="2">
		<center><strong>Stats for Existing File named <?php echo "$dir/$_POST[existing_file]"; ?>
		</td></tr>
		<?php
		$file_info_array = file_info("$dir/$_POST[existing_file]");

		foreach ($file_info_array as $key=>$val) {
			echo "<tr><th width=\"30%\">". ucfirst($key)
			. "</td><td width=\"70%\">" . $val
			. "</td></tr>\n";
		}
		?>
		</table>
		<br>
		<table border="1" align="center"><tr><td>
		<strong>Editing Existing File named <?php echo $_POST['existing_file']; ?></strong>
		</td></tr>
		<tr><td>
		<?php

		if ($editable == 0) {
			echo $filebody;
		} else {
			?>
			<input type="hidden" name="filename" value="<?php echo $_POST['existing_file']; ?>">
			<textarea rows="4" name="filebody" cols="40" wrap="soft">
			<?php
			echo "$filebody";
			?>
			</textarea><br>
			<input type="submit" name="save_edited_file" value="Save Edited File">
			<?php
		}
		?>
		</td></tr></table>
		<?php

		break;
default;

		//display the main buttons
		?>
		<table border="1" align="center"><tr><td>
		<strong>Create (or Overwrite) New File or Edit Existing File</strong>
		</td></tr>
		<tr><td>
		<input type="submit" name="create_new_file" value="Create New File">
		<input type="text" name="filename" value="new.txt">
		</td></tr>
		<tr><td>
		<input type="submit" name="edit_existing_file" value="Edit Existing File">
		<select name="existing_file">
		<?php

		if($dp = opendir($dir)) {
			while($file = readdir($dp)) {
				if($file !== '.' && $file !== '..' && is_file($dir."/".$file)) {
				?>
					<option value="<?php echo $file; ?>"><?php echo $file; ?></option>
					<?php
				}
			}
		} else {

			error_msg("Can't open directory $dir.");
		}
		
		closedir($dp);

		?>
		</select>	
		</td></tr></table>
		<?php
		break;
}
		
?>
</form>
</body>
</html>
