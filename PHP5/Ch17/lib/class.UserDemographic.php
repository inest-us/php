<? 

require_once ("common.php");
require_once ("class.PersistableLog.php");

/**
 * Class: UserDemographic (extends PersistableLog)
 *
 * Responsibilities:
 *   Contains a single demographic question and answer.
 *
 * Collaborations:
 *   Stored in UserLog, UserLog also responsible for lifecycle.
 *
 * Holds a single user demographic, it's associated question as well
 * as the UserLog identifier for persistance.
 */
class UserDemographic extends PersistableLog
{
    private $question = "";

    function __construct ($initdict) // pass by value on purpose
    {
        $key = "";
        $this->db = LogUtils::openDatabase ();

        /*
         * See UserLog::__construct for detailed notes.
         */
        $this->setId(LogUtils::getDef ($initdict["id"],0));
        $this->setId(LogUtils::getDef ($initdict["user_log_id"], $this->id));
        $this->setProperty ("demo",     LogUtils::getDef ($initdict["demo"], 0),             "answer", LogUtils::getDef ($initdict["question"], "Demographic Answer"));
        $this->setProperty ("demo",     LogUtils::getDef ($initdict["answer"], $this->demo), "answer", LogUtils::getDef ($initdict["question"], "Demographic Answer"));
        $this->question = LogUtils::getDef($initdict["question"], "");
    }

    function setId ($id)
    {
        $this->setProperty ("id", $id, "user_log_id", "User ID");
    }

    /**
     * The order of the demo questions really matters as it is part of
     * the key.  Otherwise the question association wouldn't fly.
     */
    function setSequence ($seq)
    {
        $this->setProperty ("seq", $seq, "seq", "Sequence");
    }

    /**
     * Used to validate the UsrLog object, is called from both 
     * PersistableLog::isValid() and from the UserLog exception classes.
     */
    function getInvalidData () 
    {
        $badDataEntries = array();

        if ($this->id == null || $this->id <= 0) { 
            array_push ($badDataEntries, "'id' is zero"); 
        }

        // nothing may be a valid answer, don't check the demo
        return $badDataEntries;
    }

    function toSQL ($tableName = "user_demographics") 
    {
        return LogUtils::generateSqlInsert ($tableName, 
                                    $this->contentMetaDb, 
                                    $this->contentBase);
    }

    /**
     * Todo: this is getting old, show a third way HTML stream generation.
     */
    function toHTML ($flagQ = false)
    {
        $html = "<td class=\"\UserLog-demo\">";
        if ($flagQ && strlen($this->question) > 0) $html .= "Q: ".$this->question."A: ";
        $html .= $this->demo."</td>";
        return $html;
    }
}

?>