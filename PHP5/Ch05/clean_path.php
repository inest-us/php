<html>
<head><title></title></head>
<body>
<?php
//clean_path.php
if (isset($_POST['posted'])) {
   $path = $_POST['path'];
   $outpath = ereg_replace("\.[\.]+", "", $path);
   $outpath = ereg_replace("^[\/]+", "", $outpath);
   $outpath = ereg_replace("^[A-Za-z][:\|][\/]?", "", $outpath);
   echo "The old path is " . $path . " and the new path is " . $outpath;
}
?>
<form action="clean_path.php" method="POST">
<input type="hidden" name="posted" value="true">
Enter your file path for cleaning:
<input type="text" name="path" size="30">
<input type="submit" value="Clean">
</form>
</body>
</html>
