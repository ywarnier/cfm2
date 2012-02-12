<?php

class Object_User extends Base_GenericObject
{
    // Generic Object Requirements
    protected $arrDBItems = array(
    	'strUserName' => array('type' => 'varchar', 'length' => 255),
        'isWorker' => array('type' => 'tinyint', 'length' => 1),
        'isAdmin' => array('type' => 'tinyint', 'length' => 1),
        'hasAttended' => array('type' => 'tinyint', 'length' => 1),
        'isHere' => array('type' => 'tinyint', 'length' => 1)
    );
    protected $strDBTable = "user";
    protected $strDBKeyCol = "intUserID";
    // Local Object Requirements
    protected $intUserID = null;
    protected $strUserName = null;
    protected $isWorker = false;
    protected $isAdmin = false;
    protected $hasAttended = false;
    protected $isHere = false;

    /**
     * Get the object for the current user.
     *
     * @return object UserObject for intUserID
     */
    function brokerCurrent()
    {
        $objCache = Base_Cache::getHandler();
        $this_class = self::startNew(false);
        if (true === isset($objCache->arrCache[get_class($this_class)]['current'])
            && $objCache->arrCache[get_class($this_class)]['current'] != null
            && $objCache->arrCache[get_class($this_class)]['current'] != false
        ) {
            return $objCache->arrCache[get_class($this_class)]['current'];
        }
        $user = Object_Userauth::brokerCurrent();
        if ($user !== false) {
            $intUserID = $user->get_key('intUserID');
        } else {
            return false;
        }
        try {
            $db = Base_Database::getConnection();
            $sql = "SELECT * FROM {$this_class->strDBTable} WHERE {$this_class->strDBKeyCol} = ? LIMIT 1";
            $query = $db->prepare($sql);
            $query->execute(array($intUserID));
            $result = $query->fetchObject(get_class($this_class));
            $objCache->arrCache[get_class($this_class)]['id'][$intUserID] = $result;
            $objCache->arrCache[get_class($this_class)]['current'] = $result;
            return $result;
        } catch(PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Create a new User object
     * 
     * @param boolean $isReal Perform Creation Actions (default true)
     *
     * @return object
     */
    function startNew($isReal = true)
    {
        $this_class = new self();
        if (! $isReal) {
            return $this_class;
        }
        $objUserAuth = Object_Userauth::startNew();
        if (false !== $objUserAuth) {
            $this_class->set_key('strUserName', Base_GeneralFunctions::getValue(Base_Request::getRequest(), 'strUsername', 'An Anonymous User'));
            $this_class->create();
            $objUserAuth->set_key('intUserID', $this_class->get_key('intUserID'));
            $objUserAuth->write();
        }
        return $this_class;
        
    }
}
