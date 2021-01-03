<? 

require_once ("settings.php");
require_once ("lib/common.php");
require_once ($GLOBALS["smarty-path"].'Smarty.class.php'); 
$smarty = new Smarty;
$smarty->assign ('title', "MultiLog Reporting");

function optionMassage (&$a) {
    $a = array_pad ($a, count($a)*(-1)-1,""); // enlarge array at front
    $a[0][0] = ""; // insert blank in front
    $a = LogUtils::arrayNth($a,0); // flatten array to include only values
    return $a;
}

if ($_REQUEST['action'] <> "html") {

    // display input
    $db = LogUtils::openDatabase();

    $smarty->assign ('sites', optionMassage(LogUtils::gatherSites($db)));
    $smarty->assign ('sections', optionMassage(LogUtils::gatherSections($db)));

    LogUtils::closeDatabase($db);

    $smarty->display ("report.tpl");

} else {

    // display results
    require_once ("lib/class.UserLog.php");
    require_once ("lib/class.LogContainer.php");

    $logs = new LogContainer ($_REQUEST["start_Year"]."-".$_REQUEST["start_Month"]."-".$_REQUEST["start_Day"], 
                              $_REQUEST["stop_Year"]."-".$_REQUEST["stop_Month"]."-".$_REQUEST["stop_Day"], 
                              $_REQUEST["site"], 
                              $_REQUEST["section"]);

    $smarty->assign ('logs', $logs);
    $smarty->display ("report-html.tpl");
}

?>
