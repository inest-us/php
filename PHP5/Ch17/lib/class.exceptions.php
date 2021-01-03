<? 

require_once ("interface.DataValidation.php");

/**
 * Class: MultiLogException (extends Exception)
 *
 * Responsibilities:
 *   Serves as a base exception class and for offering human-readable
 *   opportunities for debugging the issue at hand.  As a general rule, 
 *   don't use exceptions for flow-control.
 *
 * Collaborations:
 *   Base class of all Exceptions.
 *   To be used by all classes for exception handling.
 *
 * Notice that the suggestedSolutions function is abstract thus making 
 * the class abstract and uninstiantiable.   We force subclasses to 
 * implement suggestedSolutions an offer [the meager yet universal] 
 * plumbing to display debugging issues to the user.
 *
 */
abstract class MultiLogException extends Exception
{
    protected $message = ""; // every exception has a reason
    
    /**
     * Initialize self with an error message
     */
    function __construct ($msg)
    {
        $this->message = $msg;
    }

    /**
     * Force sub-classes to implement this function.
     *
     * Should simply return an array of suggested solutions or actions
     * that the people can take in order to repair issue.
     */
    abstract function suggestedSolutions ();
    
    /**
     * Create a nice human-readable error message, depends upon sub-classes
     * implementing suggestedSolutions().
     */
    function getErrorMessage()
    {
        $message = "<h3>Error</h3>".$this->message."<br>";
        $message .= "<ul>";
        foreach ($this->suggestedSolutions() as $solution) {
            $message .= "<li>".$solution;
        }
        $message .= "</ul>";
        return ($message);
    }
}

/**
 * Class: MultiLogOpenDatabaseException (extends MultiLogException)
 *
 * Responsibilities:
 *   Offer insightful reasons why database failed to open correctly.
 *
 * Collaborations:
 *   Used by all classes for when database fails to open.
 *
 * This class implements suggestedSolutions and can thus be 
 * instantiated.  It is created and thown when the database open()
 * function call fails for whatever reason.
 */
class MultiLogOpenDatabaseException extends MultiLogException
{
    
    /**
     * Call our parent's (MultiLogException) ctor passing up an message, 
     * which should continue to be the first operation if this fuction 
     * is expanded upon.
     */
    function __construct ()
    {
        parent::__construct ("Open Database Error");
    }

    /**
     * We are forced to implement this fuction, simply return an array
     * of reasons as to why the exception was thrown.
     *
     * todo: Poke and prod the filesystem to try and answer some of
     * the very answers we are offering.
     */
    function suggestedSolutions () 
    {
        return array ("Has the initization script been run yet?",
                      "Is the directory (".$GLOBALS['dbpath'].") readable and writeable?  ...by the webserver?",
                      "Is the file (".$GLOBALS['dbname'].") readable and writable?  ...by the webserver?",
                      "Was the database pre-existing and created with the same version of sqlite as php?"
                      );
    }
}

/**
 * Class: MultiLogDatabaseQueryException (extends MultiLogException)
 *
 * Responsibilities:
 *   Offer insightful reasons why database query failed.
 *
 * Collaborations:
 *   Used by all classes for when database fails to open.
 *   Leverages LogUtils for database operations. 
 *
 * Optionally uses the current database and associated SQL from the ctor
 * to poke the environment regarding reasons as to why the said database 
 * query failed.
 */
class MultiLogDatabaseQueryException extends MultiLogException
{

    protected $sql = "";
    protected $db = null;

    /**
     * Notice that the first operation is a ctor call of our parent.
     */
    function __construct ($sql = "(no sql supplied)", $db = null)
    {
        parent::__construct ("Database Query Exception");
        $this->sql = $sql;
        $this->db = $db;
    }

    /**
     * WARNING!  WARNING!  WARNING!  WARNING!  WARNING!  WARNING!
     *
     * Exposing SQL in a production environment is a really bad idea.
     *
     * Why are we doing it?
     *
     *   1. To show you what a constructor is used for.
     *   2. To offer you a glimmer of hope when your SQL goes horribly
     *      wrong.
     *   3. To sternly warn you against doing this.  Although "security
     *      through obscurity" shouldn't be your security model, 
     *      needlessly offering an internal map of how your application
     *      works is not a good idea.
     *
     * WARNING!  WARNING!  WARNING!  WARNING!  WARNING!  WARNING!
     */
    function suggestedSolutions ()
    {
        $err = array();

        if ($this->db) {
            array_push (
                $err, "Database error: ".LogUtils::databaseError ($this->db));
        }
        array_push ($err, "Database error, suspect SQL = ".$this->sql);
        array_push ($err, "Do you have write permission?");
        array_push ($err, "Is there sufficient space for the database?");

        return $err;
    }
}

/**
 * Class: MultiLogInvalidDatabaseException (extends MultiLogException)
 *
 * Responsibilities:
 *   Offer insightful reasons why a bad database connection is being 
 *   used.
 *
 * Collaborations:
 *   Used by all classes if an invalid database connection is used.
 */
class MultiLogInvalidDatabaseException extends MultiLogException
{
    function __construct ()
    {
        parent::__construct ("Invalid Database");
    }

    function suggestedSolutions ()
    {
        return array ("Was the database correctly opened?",
                      "Was it perhaps closed twice or are you trying to save the same thing twice?");
    }
}

/**
 * Class: MultiLogInvalidDataException (extends MultiLogException)
 *
 * Responsibilities:
 *   Offer insightful reasons why your UserLog (or associated object
 *   that implements getInvalidData()
 *
 * Collaborations:
 *   Used by all classes for data validation.
 *   Depends upon classes implementing the DataValidation interface.
 */
class MultiLogInvalidDataException extends MultiLogException 
{
    // expecting something that implements DataValidation
    private $validatee = null; 

    function __construct ($v)
    {
        parent::__construct ("Invalid Data");
        $this->validatee = $v;
		
    }

    /**
     * Force a dependency upon the DataValidation function by classes
     * that throw this exception.  
     *
     * Note that we're not _forced_ to specify which interface or class
     * getInvalidData is defined in, we are simply being explicit.
     */
    function suggestedSolutions ()
    {
        return $this->validatee->getInvalidData();
    }
}

/**
 * Class: UserLogException (extends MultiLogException)
 *
 * Responsibilities:
 *   Base class to be used with or by UserLogs
 *
 * Collaborations:
 *   Dependes upon PersistableLog (UserLog's base)
 */
abstract class UserLogException extends MultiLogException
{
    protected $userLog = null;

    /**
     * Note that the function exitGracefully is defined in Persistable
     * log, which is the base class of UserLog.
     */
    function __construct ($userLog, $message)
    {
        parent::__construct ($message);
        $this->userLog = $userLog;
        $this->userLog->exitGracefully(); // defined in PersistableLog
    }
}

/**
 * Class: LogContainerException (extends MultiLogException)
 *
 * Responsibilities:
 *   Base exception class to be used with or by LogContainer
 *
 * Collaborations:
 *   Depends upon classes implementing the DataValidation interface.
 */
abstract class LogContainerException extends MultiLogException
{
    protected $logs = null;

    function __construct ($logs, $message) {
        parent::__construct ($message);
        $this->logs = $logs;
    }

    /**
     * This function goes through every UserLog (in $logs) to determine
     * the invalid data from each one.
     */
    function suggestedSolutions ()
    {
        $solutions = array();
        foreach ($this->logs as $log) {
            $solutions = array_merge (
                $solutions, $log->getInvalidData());
        }
        return $solutions;
    }
}

/**
 * Class: LogContainerInvalidDataException 
 *            (extends LogContainerException)
 *
 * Responsibilities:
 *   Exception class to display invalid data of the LogContainer.
 *
 * Collaborations:
 *   LogContainer
 */
class LogContainerInvalidDataException extends LogContainerException
{
    function __construct ($logs) 
    {
        parent::__construct ($logs, "UserLogs contain invalid data.");
    }
}

?>