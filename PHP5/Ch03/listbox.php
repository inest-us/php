<html>
<head><title></title></head>
<body>
<?php
echo "Price Range: $_POST[Price]";
$Choice0 = $_POST['EngineSize'][0];
$Choice1 = $_POST['EngineSize'][1];
$Choice2 = $_POST['EngineSize'][2];
$Choice3 = $_POST['EngineSize'][3];
echo "<br>Engine Size(s): $Choice0";
echo "$Choice1";
echo "$Choice2";
echo "$Choice3";
?>
</body>
</html>
