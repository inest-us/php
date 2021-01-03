<? 

require_once ("common.php");
require_once ("class.UserLog.php");
require_once ("interface.DataOutput.php");

/*
 * LogContainer primarialy acts as a collection of UserLogs and is
 * this responsible for UserLog lifecycle and persistance.
 */
class LogContainer
{
    private $logs = array();
    protected $db = null;

    function __construct ($start = "",
                          $stop = "",
                          $site = "",
                          $section = "") 
    {
        $initsql = "select * from user_log where 1=1 and";
        if ($site <> "")    $initsql .= " site_id = '".$site."' and";
        if ($section <> "") $initsql .= " demo_id = '".$section."' and";
        if ($start <> "")   $initsql .= " visit_date >= '".$start."' and";
        if ($stop <> "")    $initsql .= " visit_date <= '".$stop."'";

        // remove final and?
        if (substr($initsql, strlen($initsql)-4, 4) == " and") {
            $initsql = substr($initsql, 0, strlen($initsql) - 4);
        }

        // query database
        $this->db = LogUtils::openDatabase();
        $query = LogUtils::executeQuery ($this->db, $initsql);

        if ( !$query ) {
            throw new MultiLogDatabaseQueryException ($initsql); 
        }

        $badLogs = array();
        while ($row = LogUtils::getQueryArray($query)) {
            $ul = new UserLog ($row);
            if ($ul->isValid()) {
                $ul->gatherDemographics(); // reassociate demo questions
                array_push ($this->logs, $ul);
            } else {
                array_push ($badLogs, $ul);
            }
        }

        LogUtils::closeDatabase ($this->db);
        if (count ($badLogs) > 0) {
            throw new LogContainerInvalidDataException($badLogs);
        }
    }

    function getCount () 
    {
        return count ($this->logs);
    }

    /**
     * A non-smarty way of creating HTML
     */
    function toHTML ()
    {
        $html = '<table border="0" class="LogContainerTable">';
        foreach ($this->logs as $ul) {
            $html .= $ul->toHTML();
        }
        $html .= "</table>";
        return $html;
    }

    function getUserLogs () {
        return $this->logs;
    }
}

?>