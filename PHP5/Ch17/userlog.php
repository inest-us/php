<? 

require_once ("settings.php");
require_once ("lib/class.UserLog.php");

try {
    $ul = new UserLog ($_REQUEST);
    $ul->persist();
} catch (MultiLogException $e) {
    print $e->getErrorMessage();
    print "<h3>Environment:</h3>";
    phpinfo(); // insecure
}

?>
ok

