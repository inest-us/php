<?

interface DataValidation 
{

    /**
     * Defines the validity of current state of the object. Returns
     * an array of invalid data items which are used my the exceptions
     * and for human display/debugging.
     */
    abstract function getInvalidData();
}

?>