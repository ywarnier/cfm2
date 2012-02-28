<?php
/**
 * CampFire Manager is a scheduling tool predominently used at BarCamps to 
 * schedule talks based, mainly, on the number of people attending each talk
 * receives.
 *
 * PHP version 5
 *
 * @category Default
 * @package  CampFireManager2
 * @author   Jon Spriggs <jon@sprig.gs>
 * @license  http://www.gnu.org/licenses/agpl.html AGPLv3
 * @link     https://github.com/JonTheNiceGuy/cfm2 Version Control Service
 */
/**
 * This class defines the object for PDO to use when retrives data about a slot.
 * 
 * @category Object_Slot
 * @package  CampFireManager2
 * @author   Jon Spriggs <jon@sprig.gs>
 * @license  http://www.gnu.org/licenses/agpl.html AGPLv3
 * @link     https://github.com/JonTheNiceGuy/cfm2 Version Control Service
 */

class Object_Slot extends Base_GenericObject
{
    // Generic Object Requirements
    protected $arrDBItems = array(
    	'dateStart' => array('type' => 'date'),
        'timeStart' => array('type' => 'time'),
        'dateEnd' => array('type' => 'date'),
        'timeEnd' => array('type' => 'time'),
        'intDefaultSlotTypeID' => array('type' => 'integer', 'length' => 11)
    );
    protected $strDBTable = "slot";
    protected $strDBKeyCol = "intSlotID";
    protected $mustBeAdminToModify = true;
    // Local Object Requirements
    protected $intSlotID = null;
    protected $dateStart = null;
    protected $timeStart = null;
    protected $dateEnd = null;
    protected $timeEnd = null;
    protected $intDefaultSlotTypeID = null;
    protected $isAvailable = true;

    /**
     * This overloaded function returns the data from the PDO object and adds
     * supplimental data based on linked tables
     * 
     * @return array
     */
    function getSelf()
    {
        $self = parent::getSelf();
        if ($this->getFull() == true) {
            if ($this->intDefaultSlotTypeID != null && $this->intDefaultSlotTypeID > 0) {
                $objDefaultSlotType = Object_DefaultSlotType::brokerByID($this->intDefaultSlotTypeID);
                if (is_object($objDefaultSlotType)) {
                    $self['arrDefaultSlotType'] = $objDefaultSlotType->getSelf();
                }
            }
        }
        return $self;
    }

    
}

/**
 * This class defines some default and demo data for the use in demos.
 * 
 * @category Object_Slot
 * @package  CampFireManager2
 * @author   Jon Spriggs <jon@sprig.gs>
 * @license  http://www.gnu.org/licenses/agpl.html AGPLv3
 * @link     https://github.com/JonTheNiceGuy/cfm2 Version Control Service
 */

class Object_Slot_Demo extends Object_Slot
{
    protected $mustBeAdminToModify = false;
    protected $arrDemoData = array(
        array('intSlotID' => 1, 'dateStart' => '', 'timeStart' => '09:00', 'dateEnd' => '', 'timeEnd' => '09:45', 'intDefaultSlotTypeID' => 1),
        array('intSlotID' => 2, 'dateStart' => '', 'timeStart' => '10:00', 'dateEnd' => '', 'timeEnd' => '10:45', 'intDefaultSlotTypeID' => null),
        array('intSlotID' => 3, 'dateStart' => '', 'timeStart' => '11:00', 'dateEnd' => '', 'timeEnd' => '11:45', 'intDefaultSlotTypeID' => null),
        array('intSlotID' => 4, 'dateStart' => '', 'timeStart' => '12:00', 'dateEnd' => '', 'timeEnd' => '12:45', 'intDefaultSlotTypeID' => 2),
        array('intSlotID' => 5, 'dateStart' => '', 'timeStart' => '13:00', 'dateEnd' => '', 'timeEnd' => '13:45', 'intDefaultSlotTypeID' => null),
        array('intSlotID' => 6, 'dateStart' => '', 'timeStart' => '14:00', 'dateEnd' => '', 'timeEnd' => '14:45', 'intDefaultSlotTypeID' => null),
        array('intSlotID' => 7, 'dateStart' => '', 'timeStart' => '15:00', 'dateEnd' => '', 'timeEnd' => '15:45', 'intDefaultSlotTypeID' => null),
        array('intSlotID' => 8, 'dateStart' => '', 'timeStart' => '16:00', 'dateEnd' => '', 'timeEnd' => '16:45', 'intDefaultSlotTypeID' => null),
        array('intSlotID' => 9, 'dateStart' => '', 'timeStart' => '17:00', 'dateEnd' => '', 'timeEnd' => '17:45', 'intDefaultSlotTypeID' => 3)
    );
}