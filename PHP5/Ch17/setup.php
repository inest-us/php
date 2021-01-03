<?
require_once ("settings.php");
require_once ("lib/common.php");

try {

    // will run it
    require_once ("logs/initialize.php");

} catch (MultiLogException $e) {
    print "<h3>An error has occured.</h3>";
    print $e->getErrorMessage();
}
?>
<h3>done</h3>
