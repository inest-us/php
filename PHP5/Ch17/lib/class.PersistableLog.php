<? 

require_once ("interface.DataOutput.php");
require_once ("interface.DataValidation.php");

/**
 * Class: PersistableLog (implements DataValidation)
 *
 * Responsibilities:
 *   Offers tools and the functionality to persist a php class to a 
 *   database.
 *
 * Collaborations:
 *   Depends upon classes implementing the DataValidation interface.
 *   Leverages LogUtils for database abstraction.
 *
 * PersistableLog is the plumbing used to persist generic table-based 
 * data to and from a database. 
 */
abstract class PersistableLog implements DataValidation
{

    /**
     * The following three arrays are respectively used to store field, 
     * human and database meta information of said field.
     */
    protected $contentBase = array();
    protected $contentMetaHuman = array();
    protected $contentMetaDb = array();

    protected $db = null;

    /**
     * Implements the php __get interface.
     * 
     * Intercepts the property request because we store local state
     * in an associative array.  $obj->whatever call will cause a
     * lookup similar to $this->data['whatever']
     */
    function __get ($key)
    {
        if (array_key_exists ($key, $this->contentBase)) {
            return $this->contentBase[$key];
        }
        return null;
    }

    /**
     * Implements the php __set interface.
     *
     * The opposite of __get, only not required or used by this 
     * application.  Example only.
     */
    function __set ($key, $value)
    {
        if (array_key_exists ($key, $this->contentBase)) {
            $this->contentBase[$key]=$value;
        }
    }

    /**
     * Destructor
     *
     * Call exitGracefully, descendent classes are free to override 
     * the exitGracefully function.
     */
    function __destruct () 
    {
        $this->exitGracefully();
    }

    /**
     * Since we officially can't 'count' on when destructors are called
     * this is done to explicitly release open resources.
     */
    function exitGracefully ()
    {
        LogUtils::closeDatabase ($this->db); // does nothing
        $this->db = null; // generic way of testing an open db connection
    }

    /**
     * Convenience function that sets local state with $key, associates
     * it to $metaDB for database storage as tell as $metaHuman for
     * display purposes.
     */
    function setProperty ($key, $value, $metaDb, $metaHuman)
    {
        //print "<pre> $key | $value | $metaDb | $metaHuman";
        $this->contentBase[$key] = $value;
        $this->contentMetaHuman[$key] = $metaHuman;
        $this->contentMetaDb[$key] = $metaDb;
    }

    function getProperties () {
        return $this->contentBase;
    }

    function getPropertiesMeta () {
        return $this->contentMetaHuman;
    }

    /**
     * Create a SQL insert statement based on our internal state and 
     * the $contentBase to $contentMetaDb associations.
     *
     * This works quite well if you have the ssociations correct.
     */
    function toSQL ($tableName = "user_log") 
    {
        return LogUtils::generateSqlInsert (
            $tableName, $this->contentMetaDb, $this->contentBase);
    }

    /**
     * Persists a valid object to the database.  Validity is checked by
     * isValid and exitGracefull is called afterward to ensure that
     * each object is persisted exactly once.
     *
     * It uses $contentBase's associated $contentMetaDb, which is used
     * very much like a mapping.
     */
    function persist () 
    {
        $rowid = 0;

        // do not bother to continue if this object is not valid.
        if (!$this->isValid()) {
            throw new MultiLogInvalidDataException ($this); 
        }

        // we should only persist ourselves once
        if ($this->db == null) {
            throw new MultiLogInvalidDatabaseException($this);
        }

        // generate sql insert and execute it
        if (LogUtils::executeQuery($this->db, $this->toSQL())) {
            $rowid = LogUtils::getLastInsertedRowId ($this->db);
            $this->exitGracefully();
        } else {
            throw new MultiLogDatabaseQueryException ($this->toSQL(), 
                                                      $this->db);
        }

        // Utilizing the primary key is often a handy thing as it is
        // essentially the unique [database] identifier.  If we have it, 
        // return it.
        return $rowid; 
    }

    /**
     * Boolean version of getInvalidData()
     */
    function isValid () 
    {
        if (count ($this->getInvalidData()) == 0) {
            return true;
        }

        return false;
    }
	
}

?>
